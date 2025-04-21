<!--Las cuatro tarjetas principales-->
    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php echo ROOT_URL;?>assets/images/prince.png" alt="" class="img-fluid img-cover rounded-2 ms-4 object-fit-cover">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover Fantasy books!</h5>
                <p>Fantasy literature is literature set in an imaginary universe, often but not always without any locations, events, or people from the real world.</p>
                <p>Magic, the supernatural and magical creatures are common in many of these imaginary worlds. </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php echo ROOT_URL;?>assets/bookImages/agathaChristie.jpg" alt="" class="img-fluid img-cover rounded-2 ms-4 object-fit-cover">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover Mystery books!</h5>
                <p>Mystery literature is all about suspense, secrets, and solving puzzles. These stories usually follow a detective or amateur sleuth working to uncover the truth behind a crime or strange event.</p>
                <p>Clues keep readers guessing until the very end. </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php echo ROOT_URL;?>assets/bookImages/theMapOfLonging.jpg" alt="" class="img-fluid img-cover object-fit-cover rounded-2 ms-4">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover Romance books!</h5>
                <p>Romance literature focuses on love, relationships, and emotional connections. These stories often follow characters of falling in love or finding their soulmate.</p>
                <p>Romance books are filled with passion, tension, and the hope of a happy ending. </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php echo ROOT_URL;?>assets/bookImages/HarryPotter1.jpg" alt="" class="img-fluid img-cover rounded-2 ms-4 object-fit-cover">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover Fiction books!</h5>
                <p>Fiction explores imaginative worlds shaped by advanced technology, futuristic settings, or alternative realities. These stories ask big "what if" questions about humanity.</p>
                <p>Aliens, time travel, robots, and distant planets are just some of the thrilling elements you’ll find in sci-fi adventures. </p>
            </div>
        </div>
    </div>


<!-- Lending Service -->
<div class="me-3">
    <div class="bg-color p-3 rounded-4 shadow ">
        <h3 class="fw-bold">Discover Our Book Lending Service</h3>
        <p>Explore a wide range of genres and borrow books easily from our extensive collection. Enjoy the convenience of reading your favorite books from the comfort of your home.</p>

        <?php if (isset($_SESSION['is_logged_in'])): ?>
            <a class="btn btn-primary-color shadow rounded-2 py-2 col-xl-3 col-md-12 col-12" href="<?php ROOT_URL?>borrow">Learn More</a>
        <?php else:?>
            <button class="btn btn-primary-color col-xl-3 col-md-12 col-12" data-bs-toggle="modal" data-bs-target="#modalToLoggin">Learn More</button>
        <?php endif; ?>
    </div>
</div>

<!-- Book Recomendations -->
<div class="me-3 mt-4">
    <div class="bg-color p-3 rounded-4 shadow ">
        <h3 class="fw-bold">Book Recomendations</h3>
        <div class="row">
            <?php foreach ($viewmodel as $item): ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4 ">
                    <a href="<?php echo ROOT_PATH?>borrow/show/<?php echo $item['ID']?>">
                        <img src="<?php echo ROOT_URL.$item['image']; ?>"
                             alt="<?php echo ROOT_URL.$item['title']; ?>"
                             class="w-100 object-fit-cover rounded-3 static-height">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Buttons -->
<div class="d-flex justify-content-center mt-4">
    <a class="btn-primary-color shadow me-3 px-3 py-2" href="<?php echo ROOT_URL?>contactUs">Contact Us</a>
    <a class="btn-primary-color shadow px-3 py-2" href="<?php echo ROOT_URL?>us">Known Us</a>
</div>

<!-- Connect With Other Readers -->
<div class="me-3 mt-4">
    <div class="bg-color p-3 rounded-4 shadow ">
        <h3 class="fw-bold">Connect with Other Readers</h3>
        <p>Welcome to the Community Zone, where book lovers like you come together to share their thoughts,
            ideas, and experiences about their favorite reads. This is more than just a section of our website—it's a
            vibrant social space for bibliophiles to connect, explore, and inspire one another.</p>
        <?php if (isset($_SESSION['is_logged_in'])): ?>
            <a class="btn btn-primary-color col-xl-3 col-md-12 col-12" href="<?php ROOT_URL?>community">Learn More</a>
        <?php else:?>
            <button class="btn btn-primary-color col-xl-3 col-md-12 col-12" data-bs-toggle="modal" data-bs-target="#modalToLoggin">Learn More</button>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalToLoggin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Oops!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You need to log in to enter here!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>users/login">Go</a>
            </div>
        </div>
    </div>
</div>