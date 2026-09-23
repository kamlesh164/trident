<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$testimonials = [];
$sql = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 5");
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        $testimonials[] = $row;
    }
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
    <link href="css/home.css" rel="stylesheet">

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
                    <h1 class="display-1 mb-0 animated slideInLeft">Testimonial</h1>
                </div>
                <div class="col-lg-6 animated slideInRight">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Pages</a></li>
                            <li class="breadcrumb-item text-secondary active" aria-current="page">Testimonial</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- Testimonials Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-2">What Our <span class="text-uppercase text-primary bg-light- px-2-">Clients</span> Says</h1>
            <p class="mb-5">Our clients’ satisfaction is our biggest achievement.</p>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9">
                    <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.2s">

                        <!-- Testimonial 1 -->
                        <!-- <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="img/testimonial-1.jpg" alt="Client 1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Professional & Creative Team</h3>
                                        <div class="rating" style="--rating:4.5" aria-label="4.5 out of 5"></div>
                                        <span class="rating-value">4.5</span>
                                        <p>“Professional, creative, and punctual team. Our office looks incredible now.”
                                        </p>
                                        <h5 class="mb-0">Kiran Mishra, Tech Startup Founder</h5>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Testimonial 2 -->
                        <!-- <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="img/testimonial-2.jpg" alt="Client 2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Elegant & Quality Designs</h3>
                                        <div class="rating" style="--rating:5" aria-label="5 out of 5"></div>
                                        <span class="rating-value">5.0</span>
                                        <p>“Tridents completely transformed our apartment. Every detail reflects quality
                                            and elegance.”</p>
                                        <h5 class="mb-0">Priya Sharma, Hyderabad</h5>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Testimonial 3 -->
                        <!-- <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="img/testimonial-3.jpg" alt="Client 3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Exceeded Expectations</h3>
                                        <div class="rating" style="--rating:4" aria-label="4 out of 5"></div>
                                        <span class="rating-value">4.0</span>
                                        <p>They understood our taste perfectly and delivered beyond expectations.
                                            Excellent work!</p>
                                        <h5 class="mb-0">Akhil Desai, Homeowner</h5>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <?php if(!empty($testimonials)): ?>
                            <?php foreach($testimonials as $k => $row): ?>
                                <div class="testimonial-item">
                                    <div class="row g-5 align-items-center">
                                        <div class="col-md-6">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="<?php echo 'admin/'.$row['image']; ?>" alt="Client 3">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="testimonial-text pb-5 pb-md-0">
                                                <h3><?php echo $row['title']; ?></h3>
                                                <div class="rating" style="--rating:<?php echo $row['star']; ?>" aria-label="<?php echo $row['star']; ?> out of 5"></div>
                                                <span class="rating-value"><?php echo $row['star']; ?></span>
                                                <p><?php echo $row['description']; ?></p>
                                                <h5 class="mb-0"><?php echo trim(string: $row['name']); ?><?php echo (!empty($row['designation'])?', '.trim($row['designation']):''); ?><?php echo (!empty($row['city'])?', '.trim($row['city']):''); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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