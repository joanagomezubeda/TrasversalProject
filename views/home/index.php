<!--Las cuatro tarjetas principales-->
    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php ROOT_URL;?>assets/images/prince.png" alt="" class="img-fluid img-cover rounded-2 ms-4">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover fantasy books!</h5>
                <p>Fantasy literature is literature set in an imaginary universe, often but not always without any locations, events, or people from the real world.</p>
                <p>Magic, the supernatural and magical creatures are common in many of these imaginary worlds. </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php ROOT_URL;?>assets/images/prince.png" alt="" class="img-fluid img-cover rounded-2 ms-4">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover fantasy books!</h5>
                <p>Fantasy literature is literature set in an imaginary universe, often but not always without any locations, events, or people from the real world.</p>
                <p>Magic, the supernatural and magical creatures are common in many of these imaginary worlds. </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php ROOT_URL;?>assets/images/prince.png" alt="" class="img-fluid img-cover rounded-2 ms-4">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover fantasy books!</h5>
                <p>Fantasy literature is literature set in an imaginary universe, often but not always without any locations, events, or people from the real world.</p>
                <p>Magic, the supernatural and magical creatures are common in many of these imaginary worlds. </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="shadow rounded-4 bg-color d-flex py-3">
            <img src="<?php ROOT_URL;?>assets/images/prince.png" alt="" class="img-fluid img-cover rounded-2 ms-4">
            <div class="mx-4 text-justify">
                <h5 class="fw-bold">Discover fantasy books!</h5>
                <p>Fantasy literature is literature set in an imaginary universe, often but not always without any locations, events, or people from the real world.</p>
                <p>Magic, the supernatural and magical creatures are common in many of these imaginary worlds. </p>
            </div>
        </div>
    </div>


<!-- Lending Service -->
<div class="me-3">
    <div class="bg-color p-3 rounded-4 shadow ">
        <h3 class="fw-bold">Discover Our Book Lending Service</h3>
        <p>Explore a wide range of genres and borrow books easily from our extensive collection. Enjoy the convenience of reading your favorite books from the comfort of your home.</p>
        <a class="btn btn-primary-color shadow rounded-2 w-25 py-2">Learn More</a>
    </div>
</div>

<!-- Book Recomendations -->
<div class="me-3 mt-4">
    <div class="bg-color p-3 rounded-4 shadow ">
        <h3 class="fw-bold">Book Recomendations</h3>
        <div class="row">
            <?php foreach ($viewmodel as $item): ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4 ">
                    <img src="<?php echo ROOT_URL.'assets/'.$item['image']; ?>"
                         alt=""
                         class="w-100 object-fit-cover rounded-3 static-height">
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
        <a class="btn btn-primary-color w-25">Learn More</a>
    </div>
</div>