<?php Messages::display();?>

<div class="row d-flex justify-content-sm-center justify-content-lg-start min-vh-100">
    <div class="d-flex justify-content-md-center justify-content-lg-start">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET" class="mb-3 col-12 col-md-9 col-lg-2">
            <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?>">
            <select name="filterByGenre" id="filterByGenre" class="form-select" onchange="this.form.submit()">
                <option value="" <?php echo empty($viewmodel['selectedGenre']) ? 'selected' : ''; ?>>
                    All Books
                </option>
                <?php foreach ($viewmodel['genres'] as $item): ?>
                    <option value="<?php echo $item['genre']; ?>"
                        <?php echo ($viewmodel['selectedGenre'] === $item['genre']) ? 'selected' : ''; ?>>
                        <?php echo $item['genre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <?php foreach ($viewmodel['books'] as $item): ?>
        <div class="col-md-9 col-lg-6 col-xl-6 col-xxl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h3 class="mt-3 text-clamp-oneLine"><?php echo $item['title'];?></h3>
                <h6><?php echo $item['author'];?></h6>
                <p class="text-clamp"><?php echo $item['description'];?></p>
                <div class="d-flex justify-content-center gap-3 flex-md-row flex-column">
                    <?php if ($_SESSION['user_data']['address']): ?>
                        <?php if ($item['isBorrowed']): ?>
                            <a class="btn btn-secondary-color shadow col-12 col-md-6 col-xl-6">Pending...</a>
                        <?php else:?>
                            <a class="btn btn-primary-color shadow col-12 col-xl-6" href="<?php echo ROOT_PATH; ?>borrow/borrowBook/<?=$item['ID']?>">Borrow</a>
                        <?php endif?>
                    <?php else: ?>
                        <button class="btn btn-primary-color shadow col-12  col-md-6 col-xl-6" data-bs-toggle="modal" data-bs-target="#modalToBorrow-<?php echo $item['ID']?>">Borrow</button>
                    <?php endif; ?>
                    <a class="btn btn-primary-color shadow col-12  col-md-6 col-xl-6" href="<?php echo ROOT_PATH; ?>borrow/show/<?=$item['ID']?>">See More</a>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalToBorrow-<?php echo $item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You need an address to borrow <?php echo $item['title']?>!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>users/profile/<?php echo $_SESSION['user_data']['id'] ?>">Go</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>

<?php
    $totalPages = ceil($viewmodel['total'] / $viewmodel['elementsPage']);
    $actualPage = $viewmodel['page'];

    $queryParams = $_GET;
    unset($queryParams['page']);
    $baseURL = '?' . http_build_query($queryParams);

?>

<nav aria-label="pagination bottom-0">
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