<div class="mt-5 d-flex justify-content-center">
    <div class="mx-5 d-flex justify-content-center pb-4 row col-12 col-xl-6 bg-color rounded-4">
        <div class="py-5">
            <h1 class="text-center mb-4 fw-bold">Log In!</h1>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="px-5">
                <?php Messages::display(); ?>
                <div class="form-group  mt-3">
                    <label for="name">Email or username</label>
                    <input type="text" placeholder="username@gmail.com" name="name" class="form-control form-border" id="name">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" placeholder="************" name="password" class="form-control form-border" id="password">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" value="submit">Log In</button>
                    <a class="form-text text-decoration-none" href="<?php ROOT_URL; ?>register">Aren't you registered? Sign In!</a>
                </div>
            </form>
        </div>
    </div>
</div>