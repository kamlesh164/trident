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
    <title>TRIDENTS - Interior Solution</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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


    <!-- Turnkey Interior Solutions Start -->
    <div class="container-fluid py-5" id="turnkey">
        <div class="container">
            <!-- Title & Intro (Aligned Layout Like Reference) -->
            <div class="row g-4 align-items-stretch mb-5">
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="rounded-3 overflow-hidden shadow-sm h-100">
                        <img src="img/services/service-1.jpg" alt="Turnkey Interior"
                            class="img-fluid w-100 h-100 object-fit-cover rounded-3">
                    </div>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-between wow fadeInLeft" data-wow-delay="0.2s">
                    <div>
                        <h2 class="text-primary mb-2">Your Turnkey Interior Solution</h2>
                        <h4 class="fw-semibold mb-3">Crafting complete interior solution for your dream space</h4>
                        <p class="text-muted mb-4" style="text-align: justify;">
                            Our turnkey interior solutions offer a comprehensive approach to design and implementation,
                            seamlessly integrating every aspect of the project. We transform spaces into stunning
                            reflections
                            of style and functionality. Trust <strong>Tridents Interior Solution</strong> to handle your
                            interior
                            project from start to finish, delivering excellence at every step.
                        </p>

                        <!-- Contact Us Button -->
                        <div class="mt-3">
                            <a href="/contact" class="btn btn-primary px-4 me-2 shadow-sm">
                                Contact Us
                                <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>

                    </div>

                    <div class="mt-4">
                        <img src="img/services/residential-1.jpg" alt="Small Decorative Interior"
                            class="img-fluid rounded-3 shadow-sm w-100">
                    </div>
                </div>
            </div>

            <!-- Full Width Image -->
            <div class="row mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12">
                    <img src="img/services/turnkey-3.jpg" alt="Interior Design"
                        class="img-fluid rounded-3 shadow-sm w-100 hover-zoom"
                        style="max-height: 800px; object-fit: cover;">
                </div>
            </div>


            <!-- Two Image Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <img src="img/services/hero-slider-2.jpg" alt="Living Area"
                        class="img-fluid rounded-3 shadow-sm w-100 h-100 hover-zoom">
                </div>
                <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s">
                    <img src="img/services/residential-3.jpg" alt="Dining Area"
                        class="img-fluid rounded-3 shadow-sm w-100 h-100 hover-zoom">
                </div>
            </div>

            <!-- FAQs Section -->
            <div class="faq-section mt-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="text-center mb-4">
                    <h3 class="text-primary mb-2">Frequently Asked Questions</h3>
                    <p class="text-muted mb-0">Everything you need to know about our turnkey interior services.</p>
                </div>

                <div class="accordion" id="faqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button fw-semibold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true"
                                aria-controls="faq1">
                                How does the turnkey interior design process work? </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Our turnkey interior design process begins with an initial consultation to understand
                                your needs and preferences. From there, our team handles everything from concept
                                creation to final installation, providing a seamless and hassle-free experience for you.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed fw-semibold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false"
                                aria-controls="faq2">
                                How long does a turnkey project take to complete?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The timeline depends on the project size and complexity. On average, residential
                                projects
                                take 8–12 weeks from design approval to completion.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed fw-semibold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false"
                                aria-controls="faq3">
                                Do I need to coordinate with different contractors?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Not at all. Our expert team manages everything — designers, craftsmen, vendors, and
                                project
                                schedules — ensuring a smooth, hassle-free process.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header" id="faqHeading4">
                            <button class="accordion-button collapsed fw-semibold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false"
                                aria-controls="faq4">
                                Can I customize designs during the process?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes, we keep you involved at every stage. You can share design preferences, material
                                choices, or color palettes — and we integrate them seamlessly.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline Styles -->
    <style>
        .accordion-button {
            background-color: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
            color: #000;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--bs-primary);
            color: #fff !important;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            background: #fff;
            border-radius: 0 0 10px 10px;
        }
    </style>

    <!-- Turnkey Interior Solutions End -->

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