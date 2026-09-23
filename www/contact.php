<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo (!empty($settings['site_name'])?$settings['site_name']:'TRIDENTS - Interior Solution'); ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo (!empty($settings['meta_keywords'])?$settings['meta_keywords']:''); ?>" name="keywords">
    <meta content="<?php echo (!empty($settings['meta_description'])?$settings['meta_description']:''); ?>" name="description">

    <!-- Favicon -->
    <link href="/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Space+Grotesk&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->



    <!-- Navbar Start -->
    <?php include_once 'navbar.php'; ?>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid pb-3 bg-primary- hero-header">
        <div class="container py-4">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-1 mb-0 animated slideInLeft">Contact</h1>
                </div>
                <div class="col-lg-6 animated slideInRight">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Pages</a></li>
                            <li class="breadcrumb-item text-secondary active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">Have Any Query? <span class="text-uppercase text-primary bg-light- px-2-">Contact
                        Us</span></h1>

            </div>

            <!-- First Row: Image + Form -->
            <div class="row g-5 justify-content-center align-items-center">
                <!-- Image Column -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <img src="img/hero-slider-1.jpg" class="img-fluid rounded" alt="Contact Image">
                </div>

                <!-- Form Column -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h3 class="mb-3">Reach Us to Transform Your Space with Stunning Designs!
                    </h3>
                    <div id="form-message"></div>
                    <form name="frm-contact" method="post">
                        <div class="row g-3">
                            <input type="hidden" name="phone" value="">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here" id="message"
                                        style="height: 150px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- After Form Row, Before Map Row -->
            <div class="row mt-5 wow fadeIn" data-wow-delay="0.6s">
                <div class="col-12 text-center">
                    <h2 class="mb-3" style="font-family: 'Space Grotesk', sans-serif;">Get In Touch With Us</h2>
                    <!-- Description -->
                  
                </div>
            </div>

            <!-- Second Row: Full-width Map -->
            <!-- <div class="row mt-5 wow fadeIn" data-wow-delay="0.7s">
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.123456!2d77.123456!3d12.987654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x123456789abcdef!2sSK%20Nagar%2C%20Bangalore!5e0!3m2!1sen!2sin!4v1699999999999!5m2!1sen!2sin"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div> -->

            <!-- Third Row: Contact Details -->
            <div class="row mt-5 text-center wow fadeIn" data-wow-delay="0.9s">
                <?php if (!empty($settings['site_address'])): ?>
                <div class="col-md-4 mb-3">
                    <i class="fa fa-map-marker-alt fa-2x text-primary mb-2"></i>
                    <h5>Address</h5>
                    <p><?php echo $settings['site_address']; ?></p>
                </div>
                <?php endif; ?>
                <?php if (!empty($settings['site_phone'])): ?>
                <div class="col-md-4 mb-3">
                    <i class="fa fa-phone-alt fa-2x text-primary mb-2"></i>
                    <h5>Phone</h5>
                    <p><?php echo $settings['site_phone']; ?></p>
                </div>
                <?php endif; ?>
                <?php if (!empty($settings['site_email'])): ?>
                <div class="col-md-4 mb-3">
                    <i class="fa fa-envelope fa-2x text-primary mb-2"></i>
                    <h5>Email</h5>
                    <p><?php echo $settings['site_email']; ?></p>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php include_once 'footer.php'; ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#!" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>