<?php Messages::display();?>
<div class="row d-flex justify-content-sm-center justify-content-lg-start">
    <?php foreach ($viewmodel as $item): ?>
        <div class="col-md-9 col-lg-6 col-xl-6 col-xxl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h3 class="mt-3 text-clamp-oneLine"><?php echo $item['title'];?></h3>
                <h6><?php echo $item['author'];?></h6>
                <p class="text-clamp"><?php echo $item['description'];?></p>
                <div class="d-flex justify-content-center gap-4 flex-sm-row flex-column">
                    <?php if ($_SESSION['user_data']['address']): ?>
                        <a class="btn btn-primary-color shadow w-50 w-sm-100" href="<?php echo ROOT_PATH; ?>borrow/borrowBook/<?=$item['ID']?>">Borrow</a>
                    <?php else: ?>
                        <button class="btn btn-primary-color shadow w-50 w-sm-100" data-bs-toggle="modal" data-bs-target="#modalToBorrow-<?php echo $item['ID']?>">Borrow</button>
                    <?php endif; ?>
                    <a class="btn btn-primary-color shadow w-50 w-sm-100" href="<?php echo ROOT_PATH; ?>borrow/show/<?=$item['ID']?>">See More</a>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalToBorrow-<?php echo $item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You need an address to borrow <?php echo $item['title']?>!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>users/profile/<?php echo $_SESSION['user_data']['id'] ?>">Go</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>

