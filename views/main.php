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
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid margin-logo">
            <img src="<?php echo ROOT_PATH; ?>assets/images/icon.png" alt="Icon of BookLends" class="image-width img-fluid ms-3 navbar-icon">
            <a class="navbar-brand fw-bold ms-3 fs-3" href="<?php echo ROOT_PATH; ?>">BookLends</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar for mobiles -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if(isset($_SESSION['is_logged_in'])): ?>
                    <div class=" d-lg-none mt-3">
                        <ul class="navbar-nav">
                            <?php if ($_SESSION['user_data']['rol'] === 'admin'):?>
                                <li>
                                    <a href="<?php echo ROOT_URL;?>dashboard" class="ms-2 fw-semibold">Dashboard</a>
                                </li>
                            <?php endif;?>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>" class="nav-link">Explore</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>myLibrary?page=1" class="nav-link">My Library</a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>lendZone?page=1" class="nav-link">Lend Zone</a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL?>users/profile/<?php echo $_SESSION['user_data']['id'];?>" class="nav-link">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class=" d-lg-none mt-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>home" class="nav-link">Explore</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>borrow?page=1" class="nav-link">Borrow</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ROOT_URL;?>community?page=1" class="nav-link">Community</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/login">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo ROOT_PATH;?>users/register">Register</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
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
                                <img src="<?php echo ROOT_URL;?>assets/userImages/defaultProfile.jpg" alt="Default profile icon" class="profile-image rounded-circle object-fit-cover img-fluid">
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
                <!--    Var to get in what view we are. With that var we put some div classes to look pretty -->
                <?php $viewName = get_class($this); ?>

                <ul class="list-unstyled ">

                    <div class="d-flex mx-5 mt-4 justify-content-xl-center justify-content-xxl-start <?php echo ($viewName == 'Home') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                        <li><a href="<?php echo ROOT_URL;?>" class="ms-2 fw-semibold"><i class="bi bi-bookmark-heart-fill fs-5 me-2"></i><span class="span-class">Explore</span></a></li>
                    </div>
                    <?php if(isset($_SESSION['is_logged_in'])): ?>
                        <?php if ($_SESSION['user_data']['rol'] === 'admin'):?>
                            <div class="d-flex mx-5 mt-4 justify-content-xl-center justify-content-xxl-start <?php echo ($viewName == 'Dashboard') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                                <li><a href="<?php echo ROOT_URL;?>dashboard" class="ms-2 fw-semibold"><i class="bi bi-person-heart fs-5 me-2"></i><span class="span-class">Dashboard</span></a></li>
                            </div>
                        <?php endif;?>
                        <div class="d-flex mx-5 mt-4 justify-content-xl-center justify-content-xxl-start <?php echo ($viewName == 'MyLibrary') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                            <li><a href="<?php echo ROOT_URL;?>myLibrary?page=1" class="ms-2 fw-semibold"><i class="bi bi-suit-heart-fill fs-5 me-2"></i><span class="span-class">My Library</span></a></li>
                        </div>
                        <div class="d-flex mx-5 mt-4 justify-content-xl-center justify-content-xxl-start <?php echo ($viewName == 'LendZone') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                            <li><a href="<?php echo ROOT_URL;?>lendZone?page=1" class="ms-2 fw-semibold"><i class="bi bi-postage-heart-fill fs-5 me-2"></i><span class="span-class">Lend Zone</span></a></li>
                        </div>
                    <?php endif?>
                    <div class="d-flex mx-5 mt-4 justify-content-xl-center justify-content-xxl-start <?php echo ($viewName == 'Borrow') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                        <li><a href="<?php echo ROOT_URL;?>borrow?page=1" class="ms-2 fw-semibold"><i class="bi bi-search-heart-fill fs-5 me-2"></i><span class="span-class">Borrow</span></a></li>
                    </div>
                    <div class="d-flex mx-5 mt-4 justify-content-xl-center justify-content-xxl-start <?php echo ($viewName == 'Community') ? 'bg-white shadow p-2 rounded-3' : ''; ?>">
                        <li><a href="<?php echo ROOT_URL;?>community?page=1" class="ms-2 fw-semibold"><i class="bi bi-chat-square-heart-fill fs-5 me-2"></i><span class="span-class">Community</span></a></li>
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

<!-- Aside right with the last books you saved on your library -->
<!-- As this is the main, I did a AppService to take the books of the current user -->
<?php $book = AppService::getLastBook(); ?>

<aside class="asideRight">
    <div class="d-sm-none d-lg-none d-xl-block">
        <?php if(isset($_SESSION['is_logged_in']) && count($book) > 0): ?>
            <div class="d-flex justify-content-center mt-4">
                <div class="w-75 justify-content-center">
                    <h3 class="fw-bolder mt-3">Currently Reading</h3>
                    <!-- Last book in your library -->
                    <div class="bg-white rounded-3 shadow justify-content-center mt-4">
                        <a href="<?php echo ROOT_PATH;?>borrow/show/<?php echo $book[0]['ID']?>" class="text-decoration-none a-color">
                            <img src="<?php echo ROOT_URL.$book[0]['image']; ?>" alt="<?php echo $book[0]['image'];?>" class="img-fluid rounded-top-3">
                            <div class="px-4 pt-3 pb-1">
                                <h5 class="fw-bolder text-clamp-oneLine"><?php echo $book[0]['title']?></h5>
                                <p class="fw-light text-clamp-oneLine"><?php echo $book[0]['author']?></p>
                            </div>
                        </a>
                    </div>
                    <!-- Lasts books in your library -->
                    <div>
                        <?php for($i = 1; $i < count($book); $i++): ?>
                            <div class="bg-white rounded-3 shadow justify-content-center mt-4">
                                <a href="<?php echo ROOT_PATH;?>borrow/show/<?php echo $book[$i]['ID']?>" class="text-decoration-none a-color">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo ROOT_URL.$book[$i]['image']; ?>" alt="<?php echo $book[$i]['title']; ?>" class="img-fluid rounded-3 img-main py-3 ps-3 pe-2 object-fit-cover">
                                        <div class=" pt-3 ">
                                            <h6 class="fw-bolder text-clamp-oneLine"><?php echo $book[$i]['title']?></h6>
                                            <p class="fw-light text-clamp-oneLine"><?php echo $book[$i]['author']?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endfor;?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</aside>


<!-- Main with the views  -->

<main class="min-vh-100"">
    <div class="container body-animation">
        <div class="row d-flex justify-content-center mt-4 ">
            <div class="row ">
                <?php require ($view); ?>
            </div>
        </div>
    </div>
</main>


<footer class="d-flex justify-content-center mt-4 pt-3 bottom-0">
    <div class="text-center">
        <div class="d-flex justify-content-center">
            <a href="<?php echo ROOT_URL; ?>politics/privatePolitics" class="a-brown">Private Politics</a>
            <span class="mx-1">·</span>
            <a href="<?php echo ROOT_URL; ?>politics/cookies" class="a-brown">Cookies Politics</a>
        </div>
        <p class="m-1" >Connecting readers, sharing stories. Join our community and discover a world where books aren't just read — they're shared!</p>
        <p class="m-1">Made with ❤ by book lovers. </p>
        <p class="m-1 mb-3">&copy <?php echo date("Y")?> BookLends. All rights reserved.</p>
    </div>
</footer>
</body>
</html>