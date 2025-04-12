
<div class="d-flex flex-column flex-lg-row text-justify justify-content-center mt-4">
    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8 mt-sm-5 mt-4 mt-lg-0  bg-color rounded-4 p-5 shadow">
        <h1 class="text-center mb-4 fw-bold">Edit <?php echo $viewmodel['title']?>!</h1>
        <img src="<?php echo ROOT_URL.$viewmodel['image']; ?>" alt=" <?php echo $viewmodel['title']?>" class="img-fluid p-2 object-fit-cover img-edit-book ">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="" enctype="multipart/form-data">
            <?php Messages::display(); ?>
            <!-- Title and Author -->
            <div class="form-group mt-3 d-flex flex-column flex-xl-row">
                <!-- Title -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                    <label for="title">Title</label>
                    <input type="text" value="<?php echo $viewmodel['title'] ?> " name="title" class="form-control form-border" id="title" required>
                </div>
                <!-- Author -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="author">Author</label>
                    <input type="text" value="<?php echo $viewmodel['author'] ?> " name="author" class="form-control form-border" id="author" required>
                </div>
            </div>
            <!-- Editorial and Genre -->
            <div class="form-group mt-3 d-flex flex-column   flex-xl-row">
                <!-- Editorial -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="editorial">Editorial</label>
                    <input type="text" value="<?php echo $viewmodel['editorial'] ?> " class="form-control form-border" id="editorial" name="editorial" required>
                </div>
                <!-- Genre -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-lg-0">
                    <label for="genre">Genre</label>
                    <input type="text" value="<?php echo $viewmodel['genre'] ?> " name="genre" class="form-control form-border" id="genre" required>
                </div>
            </div>
            <!-- Description -->
            <div class="mt-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-border form-control" required><?php echo $viewmodel['description'] ?></textarea>
            </div>

            <!-- Image -->
            <div class="form-group mt-3">
                <label  for="image">Image</label>
                <input type="file" name="image" class="form-control form-border" id="image">
            </div>

            <!-- Call to Action to ask if they want to lend the book -->
            <label class="form-text mt-3" for="lendTheBook">Do you want to lend the book?</label>
            <select class="form-control w-25" name="lendTheBook" id="lendTheBook">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <div class="mt-3">
                <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" >Edit the book</button>
            </div>
    </div>
</div>

