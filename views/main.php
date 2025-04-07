<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookLends</title>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
    <script src="<?php echo ROOT_PATH; ?>assets/js/bootstrap.js"></script>
    <link rel="icon" href="<?php echo ROOT_PATH; ?>assets/images/icon.png" type="image/x-icon">
    <!--    Libreria de iconos de bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="<?php echo ROOT_PATH; ?>assets/images/icon.png" alt="" class="image-width img-fluid ms-3 navbar-icon">
            <a class="navbar-brand fw-bold ms-2 fs-3" href="<?php echo ROOT_PATH; ?>">BookLends</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if(!isset($_SESSION['is_logged_in'])): ?>
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if(isset($_SESSION['is_logged_in'])): ?>
                    <div class=" d-lg-none mt-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>" class="nav-link">Explore</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>borrow/index" class="nav-link">Borrow</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">My Library</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Community</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>

                <form class="d-flex" role="search">
                    <input class="form-control me-2 primary-border-color " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary-outline" type="submit">Search</button>
                </form>

            </div>
        </div>
    </nav>
</header>


<aside class="asideLeft d-none d-lg-flex flex-column">
    <div class="flex-grow-1">
        <div class="userDiv">
            <?php if(isset($_SESSION['is_logged_in'])): ?>
                <div class="bg-white shadow rounded-4 asideHeight m-5 w-75 align-content-center">
                    <a class="mx-4 my-1 d-flex text-decoration-none a-color" href="#">
                        <?php if (isset($_SESSION['user_data']['image'])): ?>
                            <img src="<?php echo ROOT_URL.'assets/'.$_SESSION['user_data']['image'] ?>" alt="Profile image" class="profile-image rounded-circle object-fit-cover img-fluid">
                        <?php else: ?>
                            <img src="<?php echo ROOT_URL;?>assets/images/defaultProfile.jpg" alt="Default profile icon" class="profile-image rounded-circle object-fit-cover img-fluid">
                        <?php endif ?>
                        <div class="text-wrap">
                            <p class="mx-3 fw-bold without-margin">Welcome <?php echo $_SESSION['user_data']['name']; ?></p>
                            <p class="mx-3 without-margin"><?php echo $_SESSION['user_data']['email']; ?></p>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <nav>
            <!--    Variable para sacar en qué vista estamos  -->
            <?php $controllerName = strtolower(get_class($this));?>

            <ul class="list-unstyled">
                <div class="d-flex mx-5 mt-4 <?php echo ($controllerName == 'home') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                    <li><a href="<?php echo ROOT_URL;?>" class="ms-2 fw-semibold"><i class="bi bi-bookmark-heart-fill fs-5 me-2"></i>Explore</a></li>
                </div>
                <div class="d-flex mx-5 mt-4 <?php echo ($controllerName == 'borrow') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                    <li><a href="<?php echo ROOT_URL;?>borrow" class="ms-2 fw-semibold"><i class="bi bi-search-heart-fill fs-5 me-2"></i>Borrow</a></li>
                </div>
                <div class="d-flex mx-5 mt-4 <?php echo ($controllerName == 'myLibrary') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                    <li><a href="#" class="ms-2 fw-semibold"><i class="bi bi-suit-heart-fill fs-5 me-2"></i>My library</a></li>
                </div>
                <div class="d-flex mx-5 mt-4 <?php echo ($controllerName == 'community') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                    <li><a href="#" class="ms-2 fw-semibold"><i class="bi bi-chat-square-heart-fill fs-5 me-2"></i>Community</a></li>
                </div>

            </ul>
        </nav>
    </div>

    <div class="mt-auto mx-5 mb-4">
        <ul class="list-unstyled">
            <?php if(isset($_SESSION['is_logged_in'])): ?>
                <li>
                    <a href="<?php echo ROOT_PATH;?>users/logout" class=" fw-semibold">
                        <i class="bi bi-person-dash fs-4 border-black"></i>
                        Logout
                    </a>
                </li>
            <?php else: ?>
                <li><a class="mx-2 fw-semibold" href="<?php echo ROOT_PATH;?>users/register">Register</a></li>
                <li><a class="mx-2 fw-semibold" href="<?php echo ROOT_PATH;?>users/login">Login</a></li>
            <?php endif ?>
        </ul>
    </div>
</aside>


<aside class="asideRight">
    <h1>adios</h1>
</aside>
<div class="container body-animation">
    <div class="row d-flex justify-content-center mt-5">
        <div class="row ">
            <?php Messages::display(); ?>
            <?php require ($view); ?>
        </div>
    </div>
</div>

<!--<footer class="d-flex justify-content-center mt-4 pt-3">-->
<!--    <p>&copy 2025 Joana</p>-->
<!--</footer>-->
</body>
</html>