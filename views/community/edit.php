
<div class="d-flex flex-column flex-lg-row text-justify justify-content-center mt-4">
    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8 mt-sm-5 mt-4 mt-lg-0  bg-color rounded-4 p-5 shadow">
        <h1 class="text-center mb-4 fw-bold">Edit Comment!</h1>
        <img src="<?php echo ROOT_URL.$viewmodel['publication_image']; ?>" alt=" <?php echo $viewmodel['publication_image']?>" class="img-fluid p-2 object-fit-cover img-edit-book ">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="" enctype="multipart/form-data">
            <?php Messages::display(); ?>
            <div class="form-group mt-3 d-flex flex-column flex-xl-row">
                <div class="col-12 mt-3 mt-xl-0">
                    <!-- Description -->
                    <div class="mt-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="10" rows="10" class="form-border form-control"><?php echo $viewmodel['description'] ?></textarea>
                    </div>

                    <!-- Image -->
                    <div class="form-group mt-3">
                        <label  for="publication_image">Image</label>
                        <input type="file" name="publication_image" class="form-control form-border" id="publication_image">
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" >Edit the comment</button>
                    </div>
                </div>
            </div>
    </div>
</div>

