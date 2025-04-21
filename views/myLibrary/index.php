<div class="d-flex justify-content-between ">
    <button class="btn btn-primary-color shadow "><i class="bi bi-funnel-fill"></i></button>
    <a class="btn btn-primary-color shadow me-4 " href="<?php echo ROOT_PATH; ?>myLibrary/add">Add a new book</a>
</div>
<div class="row d-flex justify-content-sm-center justify-content-lg-start mt-4">
    <?php foreach ($viewmodel as $item): ?>
        <div class="col-md-9 col-lg-6 col-xl-6 col-xxl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h4 class="mt-3 text-clamp-oneLine fw-bold"><?php echo $item['title'];?></h4>
                <h6><?php echo $item['author'];?></h6>
                <p class="fw-light">Genre: <?php echo $item['genre']?></p>
                <a class="btn btn-primary-color shadow w-100" href="<?php echo ROOT_PATH; ?>borrow/show/<?php echo $item['ID']?>">Show</a>
                <div class="d-flex justify-content-center gap-4 flex-sm-row flex-column mt-3">
                    <?php if ($item['isBorrowed']):?>
                        <a class="btn btn-primary-outline shadow w-100" href="<?php echo ROOT_PATH; ?>borrow/unborrow/<?php echo $item['ID']?>">Unborrow</a>
                    <?php else:?>
                        <a class="btn btn-secondary-outline shadow w-lg-50 w-100" href="<?php echo ROOT_PATH; ?>myLibrary/edit/<?php echo $item['ID']?>">Edit</a>
                        <button class="btn btn-primary-outline shadow  w-lg-50 w-100" data-bs-toggle="modal" data-bs-target="#modalToDelete-<?php echo $item['ID']?>">Delete</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalToDelete-<?php echo $item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?php echo $item['title']?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>myLibrary/delete/<?=$item['ID']?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>

