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
                    <h1 class="display-1 mb-0 animated slideInLeft">Services</h1>
                </div>
                <div class="col-lg-6 animated slideInRight">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Pages</a></li>
                            <li class="breadcrumb-item text-secondary active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Service Start -->
    <div class="container-fluid py-3">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="mb-5">Our Creative <span
                            class="text-uppercase text-primary bg-light- px-2-">Services</span></h1>
                    <p>We offer end-to-end interior solutions that bring comfort, aesthetics, and functionality together
                        in perfect balance. From innovative design concepts to flawless execution, our services are
                        crafted to enhance the way you live and work.</p>
                    <p class="mb-5">Whether you’re setting up a new home, upgrading an office, or revamping an old
                        space, Tridents Interior Solution ensures each project reflects precision, creativity, and
                        long-lasting value.</p>
                    <div class="d-flex align-items-center bg-light-">
                        <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                            <i class="fa fa-phone fa-2x text-white"></i>
                        </div>
                        <div class="px-3">
                            <h3>+1 555 123 4567</h3>
                            <span>Call us direct 24/7 for a free consultation</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-0">
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-primary">
                                <a href="#!" class="service-img position-relative mb-4">
                                    <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                                    <h3>Residential</h3>
                                </a>
                                <p class="mb-0" style="text-align: justify;">We design elegant and comfortable living
                                    spaces tailored to your lifestyle. Our residential interiors blend creativity,
                                    practicality, and timeless beauty to make every corner of your home uniquely yours.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-white">
                                <a href="#!" class="service-img position-relative mb-4">
                                    <img class="img-fluid w-100" src="img/service-2.jpg" alt="">
                                    <h3>Implement</h3>
                                </a>
                                <p class="mb-0" style="text-align: justify;">Our implementation team ensures flawless
                                    execution — from material selection to on-site work — delivering projects that match
                                    your expectations with perfection and precision.</p>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.6s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-white">
                                <a href="#!" class="service-img position-relative mb-4">
                                    <img class="img-fluid w-100" src="img/service-3.jpg" alt="">
                                    <h3>Renovation</h3>
                                </a>
                                <p class="mb-0" style="text-align: justify;">We transform outdated or underutilized
                                    spaces into modern, functional, and refreshing environments — giving your interiors
                                    a brand-new life with smart design and skilled craftsmanship.</p>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.8s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-primary">
                                <a href="#!" class="service-img position-relative mb-4">
                                    <img class="img-fluid w-100" src="img/service-4.jpg" alt="">
                                    <h3>Commercial</h3>
                                </a>
                                <p class="mb-0" style="text-align: justify;">We create dynamic and professional
                                    commercial spaces that inspire productivity and reflect your brand identity — from
                                    offices to retail, hospitality, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Testimonials Start -->
    <div class="container-fluid bg-light- py-5">
        <div class="container pb-5">
            <h1 class="mb-2">What Our <span class="text-uppercase text-primary bg-light- px-2-">Clients</span> Says</h1>
            <p class="mb-5">Our clients’ satisfaction is our biggest achievement.</p>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9">
                    <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.2s">

                        <!-- Testimonial 1 -->
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="img/testimonial-1.jpg" alt="Client 1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Professional & Creative Team</h3>
                                        <p>“Professional, creative, and punctual team. Our office looks incredible now.”
                                        </p>
                                        <h5 class="mb-0">Kiran Mishra, Tech Startup Founder</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="img/testimonial-2.jpg" alt="Client 2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Elegant & Quality Designs</h3>
                                        <p>“Tridents completely transformed our apartment. Every detail reflects quality
                                            and elegance.”</p>
                                        <h5 class="mb-0">Priya Sharma, Hyderabad</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="img/testimonial-3.jpg" alt="Client 3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Exceeded Expectations</h3>
                                        <p>They understood our taste perfectly and delivered beyond expectations.
                                            Excellent work!</p>
                                        <h5 class="mb-0">Akhil Desai, Homeowner</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials End -->




    <!-- Newsletter Start -->
    <div class="container-fluid bg-primary newsletter p-0">
        <div class="container p-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-5 ps-lg-0 text-start wow fadeIn" data-wow-delay="0.2s">
                    <img class="img-fluid w-100" src="img/newsletter.jpg" alt="">
                </div>
                <div class="col-md-7 py-5 newsletter-text wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-5">
                        <h1 class="mb-5">Subscribe the <span
                                class="text-uppercase text-primary bg-white px-2">Newsletter</span></h1>
                        <div class="position-relative w-100 mb-2">
                            <input class="form-control border-0 w-100 ps-4 pe-5" type="text"
                                placeholder="Enter Your Email" style="height: 60px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-2 me-2"><i
                                    class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                        <p class="mb-0">Be the first to know about our new projects and exclusive offers!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->


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