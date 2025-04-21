
<div class="d-flex flex-column flex-lg-row text-justify justify-content-center mt-4">
    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8 mt-sm-5 mt-4 mt-lg-0  bg-color rounded-4 p-5 shadow">
        <h1 class="text-center mb-4 fw-bold">Edit Lend Book!</h1>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="" enctype="multipart/form-data">
            <?php Messages::display();?>
            <!-- ID_User and ID_Book -->
            <div class="form-group mt-3 d-flex flex-column flex-xl-row">
                <!-- ID_User -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                    <label for="user_id">ID_User</label>
                    <input type="number" value="<?php echo $viewmodel['lendBook']['user_id']?>" name="user_id" class="form-control form-border" id="user_id" >
                </div>
                <!-- ID_Book -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                    <label for="book_id">ID_Book</label>
                    <input type="number" value="<?php echo $viewmodel['lendBook']['book_id'] ?>" name="book_id" class="form-control form-border" id="book_id" >
                </div>
            </div>
            <!-- Lend Date and Return Date -->
            <div class="form-group mt-3 d-flex flex-column   flex-xl-row">
                <!-- Lend Date -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="lend_date">Lend Date</label>
                    <input type="date" value="<?php echo $viewmodel['lendBook']['lend_date'] ?>" class="form-control form-border" id="lend_date" name="lend_date" >
                </div>
                <!-- Return Date -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-lg-0">
                    <label for="return_date">Return Date</label>
                    <input type="date" value="<?php echo $viewmodel['lendBook']['return_date'] ?>" name="return_date" class="form-control form-border" id="return_date" >
                </div>
            </div>
            <!-- Borrow User ID and User Confirmation -->
            <div class="form-group mt-3 d-flex flex-column   flex-xl-row">
                <!-- Borrow User ID -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="borrow_user_id">Borrow User ID</label>
                    <input type="number" value="<?php echo $viewmodel['lendBook']['borrow_user_id'] ?>" class="form-control form-border" id="borrow_user_id" name="borrow_user_id" >
                </div>
                <!-- User confirmation -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-lg-0">
                    <!-- Call to Action to ask if they want to confirm the lend book -->
                    <label for="userConfirmation">Confirm</label>
                    <select class="form-control form-border" name="userConfirmation" id="userConfirmation">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" >Edit the lend Book</button>
            </div>
    </div>
</div>

