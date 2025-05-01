<div class="d-flex flex-column flex-lg-row text-justify">

    <!-- Image of the user with input to change it-->
    <div class="bg-color rounded-2 div-details p-1 shadow">
        <?php if (isset($_SESSION['user_data']['image'])): ?>
            <img src="<?php echo ROOT_URL.$viewmodel['userData']['image']; ?>" alt="" class="img-fluid img-details p-2 rounded-2 object-fit-cover ">
        <?php else: ?>
            <img src="<?php echo ROOT_URL;?>assets/images/defaultProfile.jpg" alt="Default profile icon" class="img-fluid img-details p-2 rounded-2 object-fit-cover">
        <?php endif ?>
    </div>

    <!-- Form to update the data of the user -->
    <div class=" col-sm-12 col-md-12 col-lg-7 col-xl-8 ms-lg-5 mt-sm-5 mt-4 mt-lg-0">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="bg-color rounded-4 p-3 shadow" enctype="multipart/form-data">
            <?php Messages::display(); ?>
            <!-- Name and Username -->
            <div class="form-group mt-3 d-flex flex-column flex-xl-row ">
                <!-- Name -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                    <label for="completeName">Complete Name *</label>
                    <input type="text" value="<?php echo $viewmodel['userData']['name'].' '.$viewmodel['userData']['surname']?>" name="completeName" class="form-control form-border" id="completeName">
                </div>
                <!-- Username -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="username">Username *</label>
                    <input type="text" value="<?php echo $viewmodel['userData']['username']?>" name="username" class="form-control form-border" id="username" >
                </div>
            </div>
            <!-- Email and Password -->
            <div class="form-group mt-3 d-flex flex-column   flex-xl-row">
                <!-- Email -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="email">Email *</label>
                    <input type="email" value="<?php echo $viewmodel['userData']['email']?>" name="email" class="form-control form-border" id="email" >
                </div>
                <!-- Pàssword -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-lg-0">
                    <label for="password">Password *</label>
                    <input type="password" placeholder="******************" name="password" class="form-control form-border" id="password" >
                </div>
            </div>

            <!-- Email and Password -->
            <div class="form-group mt-3 d-flex flex-column   flex-xl-row">
                <!-- Address -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label for="completeAddress">Complete address</label>
                    <input type="text" value="<?php echo $viewmodel['userData']['address'].', '.$viewmodel['userData']['city'].', '.$viewmodel['userData']['province']?>" name="completeAddress" class="form-control form-border" id="completeAddress" >
                </div>
                <!-- Image -->
                <div class="form-group mt-3 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-3 mt-xl-0">
                    <label  for="image">Image</label>
                    <input type="file" name="image" class="form-control form-border" id="image">
                </div>
            </div>



            <div class="mt-3">
                <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" >Update</button>
            </div>
        </form>
    </div>

</div>


<!-- Last books the user upload to our database order by date -->
<?php if (count($viewmodel['lastBooks']) > 0): ?>
    <div class="me-3 mt-5 ">
        <div class="bg-color p-3 rounded-4 shadow ">
            <h3 class="fw-bold">Last Books</h3>
            <div class="row">
                <?php foreach ($viewmodel['lastBooks'] as $item): ?>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-4 ">
                        <a href="<?php echo ROOT_PATH?>borrow/show/<?php echo $item['ID']?>">
                            <img src="<?php echo ROOT_URL.$item['image']; ?>"
                                 alt=""
                                 class="w-100 object-fit-cover rounded-3 static-height">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif;?>




