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

    <!--    Library with pretty icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="<?php echo ROOT_PATH; ?>assets/images/icon.png" alt="Icon of BookLends" class="image-width img-fluid ms-3 navbar-icon">
            <a class="navbar-brand fw-bold ms-2 fs-3" href="<?php echo ROOT_PATH; ?>">BookLends</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar for mobiles -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if(isset($_SESSION['is_logged_in'])): ?>
                    <div class=" d-lg-none mt-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>" class="nav-link">Explore</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>borrow" class="nav-link">Borrow</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>myLibrary" class="nav-link">My Library</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>community" class="nav-link">Community</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL?>users/profile/<?php echo $_SESSION['user_data']['id'];?>" class="nav-link">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>

                <form class="d-flex ms-auto" role="search">
                    <input class="form-control me-2 primary-border-color " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary-outline" type="submit">Search</button>
                </form>

            </div>
        </div>
    </nav>
</header>

<!-- Aside left with navigation and the user card-->

<aside class="asideLeft d-lg-flex flex-column ">
    <div class="d-sm-none d-lg-flex">
        <div class="flex-grow-1">
            <div class="userDiv">
                <?php if(isset($_SESSION['is_logged_in'])): ?>
                    <div class="bg-white shadow rounded-4 asideHeight m-5 w-75 align-content-center ">
                        <a class="mx-4 my-1 d-flex text-decoration-none a-color justify-content-center" href="<?php echo ROOT_URL?>users/profile/<?php echo $_SESSION['user_data']['id'];?>">
                            <?php if (isset($_SESSION['user_data']['image'])): ?>
                                <img src="<?php echo ROOT_URL.$_SESSION['user_data']['image'] ?>" alt="Profile image" class="profile-image rounded-circle object-fit-cover img-fluid mt-1">
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

            <nav class="userNav">
                <!--    Var to get in what view. With that var we put some div classes to look pretty -->
                <?php $viewName = get_class($this); ?>

                <ul class="list-unstyled">
                    <div class="d-flex mx-5 mt-4 <?php echo ($viewName == 'Home') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                        <li><a href="<?php echo ROOT_URL;?>" class="ms-2 fw-semibold"><i class="bi bi-bookmark-heart-fill fs-5 me-2"></i>Explore</a></li>
                    </div>

                    <?php if(isset($_SESSION['is_logged_in'])): ?>
                        <div class="d-flex mx-5 mt-4 <?php echo ($viewName == 'Borrow') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                            <li><a href="<?php echo ROOT_URL;?>borrow" class="ms-2 fw-semibold"><i class="bi bi-search-heart-fill fs-5 me-2"></i>Borrow</a></li>
                        </div>
                        <div class="d-flex mx-5 mt-4 <?php echo ($viewName == 'MyLibrary') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                            <li><a href="<?php echo ROOT_URL;?>myLibrary" class="ms-2 fw-semibold"><i class="bi bi-suit-heart-fill fs-5 me-2"></i>My library</a></li>
                        </div>
                        <div class="d-flex mx-5 mt-4 <?php echo ($viewName == 'LendZone') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                            <li><a href="<?php echo ROOT_URL;?>lendZone" class="ms-2 fw-semibold"><i class="bi bi-postage-heart-fill fs-5 me-2"></i>Lend Zone</a></li>
                        </div>
                    <?php endif?>
                    <div class="d-flex mx-5 mt-4 <?php echo ($viewName == 'Community') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                        <li><a href="<?php echo ROOT_URL;?>community" class="ms-2 fw-semibold"><i class="bi bi-chat-square-heart-fill fs-5 me-2"></i>Community</a></li>
                    </div>


                </ul>
            </nav>
        </div>
    </div>

        <div class="mt-auto mx-5 mb-4 d-sm-none d-lg-block">
            <ul class="list-unstyled">
                <?php if(isset($_SESSION['is_logged_in'])): ?>
                    <li>
                        <a href="<?php echo ROOT_PATH;?>users/logout" class=" fw-semibold">
                            <i class="bi bi-person-dash fs-4 border-black"></i>
                            Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li><a class="mx-2 fw-semibold" href="<?php echo ROOT_PATH;?>users/register"><i class="bi bi-person-add fs-4 me-1"></i>Register</a></li>
                    <li><a class="mx-2 fw-semibold" href="<?php echo ROOT_PATH;?>users/login"><i class="bi bi-person fs-4 me-1"></i>Login</a></li>
                <?php endif ?>
            </ul>
        </div>
</aside>

<!-- Aside right with the last books you save on your library -->

<aside class="asideRight">
    <div class="d-sm-none d-lg-block">
        <?php if(isset($_SESSION['is_logged_in'])): ?>
           <h1>a</h1>
        <?php endif ?>
    </div>
</aside>

<!-- Main with the views  -->

<main>
    <div class="container body-animation">
        <div class="row d-flex justify-content-center mt-4">
            <div class="row ">
                <?php require ($view); ?>
            </div>
        </div>
    </div>
</main>


<!--<footer class="d-flex justify-content-center mt-4 pt-3">-->
<!--    <p>&copy 2025 Joana</p>-->
<!--</footer>-->
</body>
</html>