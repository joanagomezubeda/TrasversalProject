<?php Messages::display(); ?>
<?php if (isset($_SESSION['is_logged_in'])):?>
    <div class="bg-color p-3 shadow rounded-3">
        <form action="<?php  $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <?php Messages::display(); ?>
            <div class="d-flex">
                <img src="<?php echo $_SESSION['user_data']['image']?>" alt="User profile of <?php echo $_SESSION['user_data']['name']?>" class="rounded-circle icon-image">
                <textarea name="description" id="description" cols="10" rows="2" class="form-control bg-transparent align-content-center " placeholder="What are you reading?..."></textarea>
            </div>
            <div class="d-flex justify-content-between  mt-2 ">
                <div class="align-content-center ms-2 ">
                    <label for="publication_image"><i class="bi bi-image-fill"></i></label>
                    <input id="publication_image" type="file" class="input-type-file" name="publication_image">
                </div>
                <button class="btn btn-primary-color px-5" type="submit" name="submit">Post</button>
            </div>
        </form>
    </div>
<?php endif; ?>
<div class="mt-2">
    <?php foreach ($viewmodel as $item): ?>
        <a href="<?php echo ROOT_URL?>community/show/<?php echo $item['ID']?>" class="text-black text-decoration-none">
            <div class="bg-color shadow rounded-3 mt-4 p-3">
                <div class="d-flex align-content-center">
                    <img src="<?php echo $item['image']?>" alt="User profile of <?php echo $item['username']?>" class="rounded-circle icon-image ">
                    <h6 class="align-content-center mt-2 ms-2 "><?php echo $item['name']?></h6>
                </div>
                <div class="mt-4 ms-2">
                    <p class="text-clamp"><?php echo $item['description'] ?></p>
                    <?php if(ROOT_URL.$item['publication_image'] != 'http://localhost:8080/trasversalProject/assets/communityImages/'):?>
                        <img src="<?php echo ROOT_URL.$item['publication_image'] ?>" class="img-fluid img-publication object-fit-cover rounded-3" alt="<?php echo $item['name']?>">
                    <?php endif;?>
                </div>
                <p class="mt-3 mx-2"><i class="bi bi-chat-heart-fill fs-4"></i></p>
            </div>

        </a>

    <?php endforeach; ?>

</div>

