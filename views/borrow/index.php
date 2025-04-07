<div class="row d-flex justify-content-sm-center justify-content-lg-start">
    <?php foreach ($viewmodel as $item): ?>
        <div class="col-md-9 col-lg-6 col-xl-6 col-xxl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.'assets/'.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h3 class="mt-3"><?php echo $item['title'];?></h3>
                <h6><?php echo $item['author'];?></h6>
                <p class="text-clamp"><?php echo $item['description'];?></p>
                <div class="d-flex justify-content-center gap-4 flex-sm-row flex-column">
                    <button class="btn btn-primary-color shadow w-50 w-sm-100">Borrow</button>
                    <button class="btn btn-primary-color shadow w-50 w-sm-100">See More</button>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>

