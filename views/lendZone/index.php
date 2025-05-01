<div class="row d-flex justify-content-sm-center justify-content-lg-start mt-4">
    <?php foreach ($viewmodel['books'] as $item): ?>
        <div class="col-md-9 col-lg-6 col-xl-6 col-xxl-4 mb-4">
            <div class="shadow rounded-4 bg-color py-4 px-4">
                <img src="<?php echo ROOT_URL.$item['image'];?>" alt="<?php echo $item['title']?>" class="img-fluid img-borrow rounded-2 object-fit-cover">
                <h4 class="mt-3 text-clamp-oneLine fw-bold"><?php echo $item['title'];?></h4>
                <h6><?php echo $item['author'];?></h6>
                <p class="fw-light">Genre: <?php echo $item['genre']?></p>
                <div class="d-flex justify-content-center gap-2 flex-sm-row flex-column mt-3">
                    <a class="btn btn-primary-color shadow col-12 col-lg-6" href="<?php echo ROOT_PATH; ?>lendZone/cancel/<?php echo $item['ID']?>">Cancel</a>
                    <a class="btn btn-confirm shadow col-12 col-lg-6" href="<?php echo ROOT_PATH; ?>lendZone/confirm/<?php echo $item['ID']?>">Confirm</a>
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

