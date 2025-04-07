<div class="row d-flex">
    <?php foreach ($viewmodel as $item): ?>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.'assets/'.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h3 class="mt-3"><?php echo $item['title'];?></h3>
                <h6><?php echo $item['author'];?></h6>
                <p class="text-clamp"><?php echo $item['description'];?></p>
                <div class="d-flex justify-content-center gap-4">
                    <button class="btn btn-primary-color shadow w-50">Borrow</button>
                    <button class="btn btn-primary-color shadow w-50">See More</button>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>

