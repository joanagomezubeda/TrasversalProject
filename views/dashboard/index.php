<!-- Differents divs with the options for the admin -->
<div class="mx-1 mt-3 row d-flex justify-content-center  justify-content-xxl-start">
    <div class="me-2 ">
        <h1 class="fw-bold">Dashboard</h1>
    </div>
    <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
        <a href="<?php echo ROOT_URL?>dashboard/users" class="text-decoration-none a-color">
            <div class="d-flex justify-content-between mx-4">
                <h6 class="fw-bold">Total Users</h6>
                <p><i class="bi bi-person-fill"></i></p>
            </div>
            <div class="mx-4 ">
                <h2 class="fw-bolder">+<?php echo count($viewmodel['users'])?></h2>
            </div>
        </a>
    </div>
    <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
        <a href="<?php echo ROOT_URL?>dashboard/books" class="text-decoration-none a-color">
            <div class="d-flex justify-content-between mx-4">
                <h6 class="fw-bold">Total Books</h6>
                <p><i class="bi bi-book-fill"></i></p>
            </div>
            <div class="mx-4 ">
                <h2 class="fw-bolder">+<?php echo count($viewmodel['books'])?></h2>
            </div>
        </a>
    </div>
    <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3 col-xxl-3 me-2 py-4 my-3 border">
        <a href="<?php echo ROOT_URL?>dashboard/publications" class="text-decoration-none a-color">
            <div class="d-flex justify-content-between mx-4">
                <h6 class="fw-bold">Total Publications</h6>
                <p><i class="bi bi-chat-square-heart-fill"></i></p>
            </div>
            <div class="mx-4 ">
                <h2 class="fw-bolder">+<?php echo count($viewmodel['publications'])?></h2>
            </div>
        </a>
    </div>
    <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
        <a href="<?php echo ROOT_URL?>dashboard/comments" class="text-decoration-none a-color">
            <div class="d-flex justify-content-between mx-4">
                <h6 class="fw-bold">Total Comments</h6>
                <p><i class="bi bi-chat-heart-fill"></i></p>
            </div>
            <div class="mx-4 ">
                <h2 class="fw-bolder">+<?php echo count($viewmodel['comments'])?></h2>
            </div>
        </a>
    </div>

    <div class="row justify-content-center ">
        <!-- Last Lent Books -->
        <div class="border shadow rounded-3 col-12 col-md-11 col-lg-10 col-xxl-6 mt-4 me-2">
            <a class=" a-color text-decoration-none" href="<?php ROOT_URL?>dashboard/lendBooks">
               <div class="p-3">
                   <h4 class="fw-bold">Last Lent Books</h4>
                   <p>They lent <?php echo count($viewmodel['lendBooks'])?> books in total!</p>
                   <div class="pb-3">
                       <?php foreach ($viewmodel['lendBooks'] as $item): ?>
                           <div class="d-flex align-content-center mt-3">
                               <img src="<?php echo $item['book_image']?>" class="img-fluid icon-image rounded-5 border" alt="<?php echo $item['title']?>">
                               <div>
                                   <h6 class="ms-2 align-content-center align-items-center"><?php echo $item['title']?></h6>
                                   <h6 class="ms-2 align-content-center align-items-center fw-normal">From <?php echo $item['name']?></h6>
                               </div>
                           </div>
                       <?php endforeach;?>
                   </div>
               </div>
            </a>
        </div>

        <!-- Last registered users -->
        <div class="border shadow rounded-3 col-12 col-md-11 col-lg-10 col-xxl-6 mt-4 me-2">
            <a class=" a-color text-decoration-none" href="<?php ROOT_URL?>dashboard/users">
                <div class="p-3">
                    <h4 class="fw-bold">Last Users</h4>
                    <p>There are <?php echo count($viewmodel['users'])?> new users!</p>
                    <div class="pb-3">
                        <?php foreach ($viewmodel['users'] as $item): ?>
                            <div class="d-flex align-content-center mt-3">
                                <img src="<?php echo $item['image']?>" class="img-fluid icon-image rounded-5 border" alt="<?php echo $item['name']?>">
                                <div>
                                    <h6 class="ms-2 align-content-center align-items-center"><?php echo $item['name']?></h6>
                                    <h6 class="ms-2 align-content-center align-items-center fw-normal"><?php echo $item['email']?></h6>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>

