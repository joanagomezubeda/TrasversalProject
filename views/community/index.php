<?php Messages::display(); ?>
<?php if (isset($_SESSION['is_logged_in'])):?>
    <div class="bg-color p-3 shadow rounded-3">
        <form action="<?php  $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <?php Messages::display(); ?>
            <div class="d-flex">
                <img src="<?php echo $_SESSION['user_data']['image']?>" alt="User profile of <?php echo $_SESSION['user_data']['name']?>" class="rounded-circle icon-image">
                <textarea name="description" id="description" cols="10" rows="2" class="form-control bg-transparent align-content-center " placeholder="What are you reading?..."></textarea>
            </div>
            <div class="d-flex justify-content-between  mt-2 ">
                <div class="align-content-center ms-2 ">
                    <label for="publication_image"><i class="bi bi-image-fill"></i></label>
                    <input id="publication_image" type="file" class="input-type-file" name="publication_image">
                </div>
                <button class="btn btn-primary-color px-5" type="submit" name="submit">Post</button>
            </div>
        </form>
    </div>
<?php else: ?>
    <div class="me-3 mt-4">
        <div class="bg-color p-3 rounded-4 shadow ">
            <h3 class="fw-bold">Want to join the conversation?</h3>
            <p>Log in now to leave a comment and be part of the community.</p>
            <a class="btn btn-primary-color col-xl-3 col-md-12 col-12" href="<?php ROOT_URL?>users/login">Log In to Comment</a>
        </div>
    </div>
<?php endif; ?>
<div class="mt-2 mb-5">
    <?php foreach ($viewmodel['publications'] as $item): ?>
        <a href="<?php echo ROOT_URL?>community/show/<?php echo $item['ID']?>" class="text-black text-decoration-none">
            <div class="bg-color shadow rounded-3 mt-4 p-3">
                <div class="d-flex align-content-center">
                    <img src="<?php echo $item['image']?>" alt="User profile of <?php echo $item['username']?>" class="rounded-circle icon-image ">
                    <h6 class="align-content-center mt-2 ms-2 "><?php echo $item['username']?></h6>
                </div>
                <div class="mt-4 ms-2">
                    <p class="text-clamp"><?php echo $item['description'] ?></p>
                    <?php if(ROOT_URL.$item['publication_image'] != 'http://localhost:8080/trasversalProject/assets/communityImages/'):?>
                        <img src="<?php echo ROOT_URL.$item['publication_image'] ?>" class="img-fluid img-publication object-fit-cover rounded-3" alt="<?php echo $item['name']?>">
                    <?php endif;?>
                </div>
                <p class="mt-3 mx-2"><i class="bi bi-chat-heart-fill fs-4"></i></p>
            </div>

        </a>

    <?php endforeach; ?>

</div>

<?php
    $totalPages = ceil($viewmodel['total'] / $viewmodel['elementsPage']);
    $actualPage = $viewmodel['page'];

    $queryParams = $_GET;
    unset($queryParams['page']);
    $baseURL = '?' . http_build_query($queryParams);

?>

<nav aria-label="pagination">
    <ul class="pagination justify-content-center">

        <?php if ($actualPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $baseURL ?>&page=<?= $actualPage - 1 ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $actualPage ? 'active' : '' ?>">
                <a class="page-link" href="<?= $baseURL ?>&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($actualPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $baseURL ?>&page=<?= $actualPage + 1 ?>">Next</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>