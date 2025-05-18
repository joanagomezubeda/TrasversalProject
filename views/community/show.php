<!-- Edit and delete buttons -->
<?php if ($viewmodel['publication']['id_user'] == $_SESSION['user_data']['id']): ?>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>community/edit/<?php echo $viewmodel['publication']['ID']?>">Edit</a>
        <button class="btn btn-primary-outline" data-bs-toggle="modal" data-bs-target="#modalOfPublication-<?php echo $viewmodel['publication']['id']?>">Delete</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalOfPublication-<?php echo $viewmodel['publication']['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the publication?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>community/delete/<?php echo $viewmodel['publication']['ID']?>">Delete</a>
                </div>
            </div>
        </div>
    </div>

<?php endif?>



<div class="d-flex flex-column flex-lg-row text-justify">

    <!-- Publication image and description -->
    <?php if(ROOT_URL.$viewmodel['publication']['publication_image'] != "http://localhost:8080/trasversalProject/assets/communityImages/"):?>
        <div class="bg-color rounded-2 div-details p-1 shadow">
            <img src="<?php echo ROOT_URL.$viewmodel['publication']['publication_image']; ?>" alt="" class="img-fluid img-details p-2 rounded-2 object-fit-cover ">
        </div>
        <div class=" col-sm-12 col-md-12 col-lg-7 col-xl-8 ms-lg-5 mt-sm-5 mt-4 mt-lg-0">
            <div class="bg-color shadow rounded-3 p-3">
                <div class="d-flex align-content-center">
                    <img src="<?php echo ROOT_URL.$viewmodel['publication']['image']?>" alt="User profile of <?php echo $viewmodel['publication']['name']?>" class="rounded-circle icon-image ">
                    <h6 class="align-content-center mt-2 ms-2 "><?php echo $viewmodel['publication']['username']?></h6>
                </div>
                <div class="mt-4 ms-2">
                    <p><?php echo $viewmodel['publication']['description'] ?></p>
                </div>
            </div>
        </div>
    <?php else:?>

    <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-sm-5 mt-4 mt-lg-0">
        <div class="bg-color shadow rounded-3 p-3">
            <div class="d-flex align-content-center">
                <img src="<?php echo ROOT_URL.$viewmodel['publication']['image']?>" alt="User profile of <?php echo $viewmodel['publication']['name']?>" class="rounded-circle icon-image ">
                <h6 class="align-content-center mt-2 ms-2 "><?php echo $viewmodel['publication']['name']?></h6>
            </div>
            <div class="mt-4 ms-2">
                <p><?php echo $viewmodel['publication']['description'] ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>


<!-- Call to Action to publish a comment -->
<?php if (isset($_SESSION['is_logged_in'])):?>
    <div class="bg-color p-3 shadow rounded-3 mt-5 ">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <?php Messages::display(); ?>
            <div class="d-flex">
                <img src="<?php echo ROOT_URL.$_SESSION['user_data']['image']?>" alt="User profile of <?php echo $_SESSION['user_data']['name']?>" class="rounded-circle icon-image">
                <textarea name="description" id="description" cols="10" rows="2" class="form-control bg-transparent align-content-center" placeholder="Post your response..."></textarea>
            </div>
            <div class="d-flex justify-content-between  mt-2 ">
                <div class="align-content-center ms-2 ">
                    <label for="image"><i class="bi bi-image-fill"></i></label>
                    <input id="image" type="file" class="input-type-file" name="image">
                </div>
                <button class="btn btn-primary-color px-5" type="submit" name="submit">Comment</button>
            </div>
        </form>
    </div>
<?php endif; ?>

<!-- Comments associated to the publication -->
<div class="d-flex justify-content-center row">
    <div class="mt-2 col-12 col-xl-10 ">
        <?php foreach ($viewmodel['comments'] as $item): ?>
            <div class="bg-color shadow rounded-3 mt-4 p-3">
                <div class="d-flex align-content-center">
                    <img src="<?php echo ROOT_URL.$item['profileImage']?>" alt="User profile of <?php echo $item['username']?>" class="rounded-circle icon-image ">
                    <div class="align-content-center mt-2 ms-2 d-flex">
                        <h6 class="me-2"><?php echo $item['username']?></h6>
                        <!-- Fuente: https://es.stackoverflow.com/questions/391540/cómo-calcular-tiempo-en-php-cuando-el-formato-es-datetime
                            https://stackoverflow.com/questions/53277944/how-to-set-000000-for-datetime -->
                        <h6 >
                            <?php
                                $diff = (new DateTime($item['create_time']))->diff(new DateTime());

                                if ($diff->days >= 7){
                                    echo (new DateTime($item['create_time']))->format('j M');
                                } else if ($diff->days >= 1){
                                    echo $diff->days." Days";
                                } else if ($diff->h >= 1){
                                    echo $diff->h." Hours";
                                } else {
                                    echo $diff->i." Minutes";
                                }
                            ?>
                        </h6>
                    </div>

                </div>
                <div class="mt-4 ms-2">
                    <p class="text-clamp"><?php echo $item['description'] ?></p>
                    <?php if(ROOT_URL.$item['image'] != "http://localhost:8080/trasversalProject/assets/commentImage/"):?>
                        <img src="<?php echo ROOT_URL.$item['image'] ?>" class="img-fluid img-comments object-fit-cover rounded-4" alt="<?php echo $item['id_user']?>">
                    <?php endif; ?>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>



