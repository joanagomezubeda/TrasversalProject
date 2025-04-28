<div class="text-justify mb-5">
    <h1 class="fw-bolder">Contact Us</h1>
    <p>At BookLends, we'd love to hear from you. Fill out the form below or reach out directly.</p>
    <div class="mt-4 d-flex row ">
        <div class="col-12 col-md-12 col-xl-6">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="bg-color rounded-3 p-3 shadow" enctype="multipart/form-data">
                <?php Messages::display(); ?>
                <!-- Name -->
                <div class="col-12 form-group ">
                    <label for="completeName">Complete Name *</label>
                    <input type="text" placeholder="John Doe" name="completeName" class="form-control form-border" id="completeName">
                </div>

                <!-- Email -->
                <div class="col-12 form-group ">
                    <label for="completeName">Email *</label>
                    <input type="text" placeholder="your@email.com" name="completeName" class="form-control form-border" id="completeName">
                </div>

                <!-- Subject -->
                <div class="form-group mt-3">
                    <label  for="subject">Subject</label>
                    <input type="text" name="subject" class="form-control form-border" id="subject" placeholder="How can we help you?">
                </div>

                <!-- Message -->
                <div class="form-group mt-3 ">
                    <label  for="message">Message</label>
                    <textarea name="message" id="message" cols="10" rows="5" class="form-control form-border" placeholder="Your message"></textarea>
                </div>


                <div class="mt-3">
                    <button class="btn btn-primary-color w-100 mb-2" name="submit" type="submit" >Submit</button>
                </div>
            </form>
        </div>
        <div class="d-flex col-12 col-md-12 col-xl-6 mt-4 mt-md-4 mt-xl-0 justify-content-center  justify-content-xxl-start">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2938.002362495001!2d-2.8489860208223003!3d42.576472336376675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4f8be889b93d41%3A0xc78e2bfc55d2fa79!2sPl.%20de%20la%20Paz%2C%2026200%20Haro%2C%20La%20Rioja!5e0!3m2!1ses!2ses!4v1745749843955!5m2!1ses!2ses"
                    width="520" height="480" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-3 shadow">
            </iframe>
        </div>
    </div>
    <div class="d-flex mt-4 row justify-content-center  justify-content-xxl-start ms-1">
        <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
            <div class="d-flex mx-4">
                <p><i class="bi bi-geo-alt-fill me-1"></i></p>
                <h6 class="fw-bold mt-1">Our Location</h6>
            </div>
            <div class="mx-4 ">
                <p class="fw-light">Plaza de la Paz, Haro</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
            <div class="d-flex mx-4">
                <p><i class="bi bi-telephone-fill me-1"></i></p>
                <h6 class="fw-bold mt-1">Phone Number</h6>
            </div>
            <div class="mx-4 ">
                <p class="fw-light">(+34) 123 45 67 89</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
            <div class="d-flex mx-4">
                <p><i class="bi bi-envelope-heart-fill me-1"></i></p>
                <h6 class="fw-bold mt-1">Email Adress</h6>
            </div>
            <div class="mx-4 ">
                <p class="fw-light">booklends@gmail.com</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-3 col-12 col-md-5 col-lg-5 col-xl-custom-3  col-xxl-3 me-2 py-4 my-3 border">
            <div class="d-flex mx-4">
                <p><i class="bi bi-chat-right-heart-fill me-1"></i></p>
                <h6 class="fw-bold mt-1">Connect with Us</h6>
            </div>
            <div class="mx-4 ">
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/?locale=es_ES" class="text-decoration-none a-color" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.linkedin.com/?locale=es_ES" class="text-decoration-none a-color" target="_blank"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.instagram.com/?locale=es_ES" class="text-decoration-none a-color" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.twitter.com/?locale=es_ES" class="text-decoration-none a-color" target="_blank"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>




