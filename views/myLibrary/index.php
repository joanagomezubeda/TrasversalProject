
<div class="row d-flex justify-content-sm-center justify-content-lg-start">

    <div class="row d-flex justify-content-center justify-content-lg-between mb-4 ">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET" class="col-12 col-md-9 col-lg-2">
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

        <a class="btn btn-primary-color shadow col-12 col-md-9 col-lg-2 mt-3 mt-lg-0 ms-4 ms-sm-0" href="<?php echo ROOT_PATH; ?>myLibrary/add">Add a new book</a>
    </div>

    <?php foreach ($viewmodel['books'] as $item): ?>
        <div class="col-md-9 col-lg-6 col-xl-6 col-xxl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h4 class="mt-3 text-clamp-oneLine fw-bold"><?php echo $item['title'];?></h4>
                <h6><?php echo $item['author'];?></h6>
                <p class="fw-light">Genre: <?php echo $item['genre']?></p>
                <a class="btn btn-primary-color shadow w-100" href="<?php echo ROOT_PATH; ?>borrow/show/<?php echo $item['ID']?>">Show</a>
                <div class="d-flex justify-content-center gap-4 flex-sm-row flex-column mt-3">
                    <?php if ($item['isBorrowed']):?>
                        <?php if($item['isConfirmed']):?>
                            <a class="btn btn-primary-outline shadow w-100" href="<?php echo ROOT_PATH; ?>borrow/unborrow/<?php echo $item['ID']?>">Unborrow</a>
                        <?php else:?>
                            <a class="btn btn-primary-outline shadow w-100">Pending...</a>
                        <?php endif;?>
                    <?php else:?>
                        <?php if ($item['isLent']): ?>
                            <a class="btn btn-secondary-outline shadow w-100">Lent</a>
                        <?php else:?>
                            <a class="btn btn-secondary-outline shadow w-lg-50 w-100" href="<?php echo ROOT_PATH; ?>myLibrary/edit/<?php echo $item['ID']?>">Edit</a>
                            <button class="btn btn-primary-outline shadow  w-lg-50 w-100" data-bs-toggle="modal" data-bs-target="#modalToDelete-<?php echo $item['ID']?>">Delete</button>
                        <?php endif;?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalToDelete-<?php echo $item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?php echo $item['title']?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>myLibrary/delete/<?=$item['ID']?>">Delete</a>
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
