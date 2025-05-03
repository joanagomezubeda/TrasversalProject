
<!-- Book details. If you are not logged in you could not save the book or borrow it -->
<?php Messages::display();?>
<div class="d-flex flex-column flex-lg-row text-justify">
    <div class="bg-color rounded-2 div-details p-1 ">
        <img src="<?php echo ROOT_PATH.$viewmodel['book']['image'];?>" alt="" class="img-fluid img-details p-2 rounded-2 object-fit-cover">
    </div>

    <div class=" col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-sm-3 ms-lg-5 margin-xsm">
        <h1><?php echo $viewmodel['book']['title']?></h1>
        <h6>by <?php echo $viewmodel['book']['author']?></h6>
        <p><?php echo $viewmodel['book']['description']?></p>
        <?php if (isset($_SESSION['is_logged_in'])): ?>
            <div class="d-flex flex-column flex-md-row gap-4">
                <?php if ($viewmodel['isSaved']): ?>
                    <!-- Once you save it, its like a copy in your library so you can't borrow it because its yours :) -->
                    <a class="btn btn-primary-color shadow mt-lg-3 col-xl-3 col-md-5 col-12" href="<?php echo ROOT_URL?>borrow/delete/<?php echo $viewmodel['book']['ID'] ?>">Delete</a>
                    <a class="btn btn-secondary-outline shadow mt-lg-3 col-xl-3 col-md-5 col-12" href="<?php echo ROOT_URL?>borrow/delete/<?php echo $viewmodel['book']['ID'] ?>">Edit</a>
                <?php else: ?>
                    <?php if($viewmodel['isBorrowed']): ?>
                        <?php if ($viewmodel['isConfirmed']): ?>
                            <a class="btn btn-primary-color shadow mt-lg-3 col-xl-3 col-12 " href="<?php echo ROOT_URL?>borrow/unborrow/<?php echo $viewmodel['book']['ID'] ?>">Unborrow</a>
                        <?php else: ?>
                            <a class="btn btn-primary-outline mt-lg-3 shadow w-100">Pending...</a>
                        <?php endif;?>
                    <?php else: ?>
                        <a class="btn btn-primary-color shadow mt-lg-3 col-xl-3 col-md-6 col-12 " href="<?php echo ROOT_URL?>borrow/borrowBook/<?php echo $viewmodel['book']['ID'] ?>">Borrow</a>
                        <a class="btn btn-primary-color shadow mt-lg-3 col-xl-3 col-md-5 col-12" href="<?php echo ROOT_URL?>borrow/saveBook/<?php echo $viewmodel['book']['ID'] ?>">Save</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Call to Action to do publications about the book or whatever -->

<div class="bg-color rounded-4 mt-5 me-2">
    <div class="p-4">
        <h2>Are you enjoying <?php echo $viewmodel['book']['title'];?>?</h2>
        <p>What do you think about <?php echo $viewmodel['book']['author'];?>? You could do a publication saying that! Share with us what do you
        think about this book. We want to hear your thoughts! Start a conversation with other users
        and make some friends. You're welcome to our world, where everyone wants to hear you. Also if you didn't like it, but we
        want to know why did that happen.</p>
        <a class="btn btn-primary-color col-xl-3 col-md-12 col-12 " href="<?php echo ROOT_PATH?>community">Make a publication</a>
    </div>
</div>

<!-- Carrousel of photos about related books.
    If there are no related books,
    it won't see anything. Even the h2 of "Related Books"  -->

<div id="carouselOfBooks" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" data-bs-interval="10000">

        <?php if (!empty($viewmodel['relatedBooks'])): ?>
            <div class="mt-5">
                <h2>Related Books</h2>
            </div>
        <?php endif; ?>
        <!-- Pagination -->
        <?php $chunks = array_chunk($viewmodel['relatedBooks'], 2);
        foreach ($chunks as $index => $bookGroup): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="d-flex flex-wrap justify-content-center">
                    <?php foreach ($bookGroup as $item): ?>
                        <div class="col-12 col-sm-5 col-md-5  col-xl-4 mb-4 me-3 mt-2">
                            <div class="bg-color text-clamp shadow text-align-justify px-3 pb-2 rounded">
                                <a href="<?php echo ROOT_PATH; ?>borrow/show/<?= $item['ID'] ?>" class="text-decoration-none text-black d-block" target="_self">
                                    <div class="mt-4">
                                        <img src="<?php echo ROOT_PATH . $item['image']; ?>" alt="" class="img-fluid img-details p-2 rounded-2 object-fit-cover">
                                        <h6 class="text-center"><?php echo $item['title'] ?></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselOfBooks" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselOfBooks" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        <?php endforeach; ?>

    </div>


</div>


</div>