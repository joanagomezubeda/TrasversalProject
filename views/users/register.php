
<div class="mt-5 d-flex justify-content-center">
    <div class="mx-5 d-flex justify-content-center pb-4 row col-12 col-xl-6 bg-color rounded-4">
        <div class=" py-5">
            <h1 class="text-center mb-4 fw-bold">Register User!</h1>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="px-5">
                <?php Messages::display(); ?>
                <div class="form-group">
                    <label for="completeName">Complete Name</label>
                    <input type="text" placeholder="John Doe" name="completeName" class="form-control form-border" id="completeName">
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    <input type="email" placeholder="username@gmail.com" name="email" class="form-control form-border" id="email">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" placeholder="************" name="password" class="form-control form-border" id="password">
                </div>
                <div class="form-group mt-3">
                    <label for="address">Address</label>
                    <input type="text" placeholder="Street" name="address" class="form-control form-border" id="address">
                </div>
                <div class="d-flex">
                    <div class="form-group mt-3 col-6">
                        <label for="city">City</label>
                        <input type="text" placeholder="City" name="city" class="form-control form-border" id="city">
                    </div>
                    <div class="form-group mt-3 col-6">
                        <label for="province">Province</label>
                        <input type="text" placeholder="Province" name="province" class="form-control form-border" id="province">
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" value="submit">Sing In</button>
                    <a class="form-text text-decoration-none" href="<?php ROOT_URL; ?>login">Are you registered? Log In!</a>
                </div>
            </form>
        </div>
    </div>
</div>
