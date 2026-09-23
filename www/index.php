<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$homeslider = [];
$images = mysqli_query($conn, "SELECT * FROM gallery_items WHERE type = 'home-slider' ORDER BY display_order LIMIT 3");
while ($row = mysqli_fetch_assoc($images)) {
    $homeslider[$row['display_order']] = $row['image_path'];
}
// Residential (random 4)
$residential_data = [];
$res_query = mysqli_query($conn, "SELECT * FROM services WHERE category='residential' ORDER BY RAND() LIMIT 4");
while($row = mysqli_fetch_assoc($res_query)){
    $residential_data[] = $row;
}

// Commercial (random 4)
$commercial_data = [];
$com_query = mysqli_query($conn, "SELECT * FROM services WHERE category='commercial' ORDER BY RAND() LIMIT 4");
while($row = mysqli_fetch_assoc($com_query)){
    $commercial_data[] = $row;
}

$ourservices = [];
$sql = mysqli_query($conn, "SELECT * FROM services WHERE category = 'our-services' ORDER BY created_at ASC LIMIT 8");
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        $ourservices[] = $row;
    }
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
    <div class="container-fluid pb-5- hero-header mb-5-">
        <div class="container py-5-">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6">
                    <h1 class="display-3 mb-4 animated slideInRight">Transforming Spaces Into <span
                            class="text-primary">Timeless Designs</span></h1>

                    <p class="lead mb-4 animated slideInRight" style="max-width: 550px;">
                        At Tridents Interior Solution, we turn your dream space into reality blending luxury,
                        functionality, and modern aesthetics that reflect your personality.
                    </p>
                    <a href="/contact" class="btn btn-primary py-3 px-5">
                        Book Free Consultation <i class="fa fa-arrow-right ms-2"></i>
                    </a>
                    <!--<h5 class="d-inline-block border border-2 border-white py-3 px-5 mb-0 animated slideInRight">
                        An Award Winning Studio Since 1990</h5>-->
                </div>
                <?php if(count($homeslider) > 0): ?>
                <div class="col-lg-6">
                    <div class="owl-carousel header-carousel animated fadeIn">
                        <!-- <img class="img-fluid" src="img/hero-slider-1.jpg" alt="">
                        <img class="img-fluid" src="img/hero-slider-2.jpg" alt="">
                        <img class="img-fluid" src="img/hero-slider-3.jpg" alt=""> -->
                        <?php foreach($homeslider as $image_path): ?>
                            <img class="img-fluid" src="<?php echo 'admin/'.$image_path; ?>" alt="Hero Slider Image">
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-4">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Image Column -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid h-100" style="object-fit: cover;" src="img/about.jpg" alt="">
                </div>

                <!-- Right Description Column -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-3"><span class="text-uppercase text-primary bg-light- px-2-">About Us</span></h1>

                    <h3 class="mb-3">Transforming Interiors With Creativity</h3>
                    <p class="mb-4">
                        At Tridents Interior Solution, we focus on delivering spaces that are both functional and aesthetically captivating. Our designs combine modern trends with timeless elegance to reflect your unique personality.
                    </p>

                    <p class="mb-4">
                        At Tridents Interior Solution, we blend creativity, luxury, and functionality to craft interiors
                        that reflect your lifestyle and personality. Every project we take on is an opportunity to turn
                        your vision into a beautiful, practical, and timeless space.
                    </p>
                    <p class="mb-5">
                        Our team of skilled designers and craftsmen ensures that each detail is carefully considered,
                        creating interiors that are both elegant and highly functional, tailored perfectly to your
                        unique style.
                    </p>

                    <div class="d-flex align-items-center mt-5">
                        <a class="btn btn-primary px-4 me-2" href="/about">Explore More <i
                                class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Choose Us Start -->
    <div class="container-fluid bg-light- py-4">
        <div class="container">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">Why People <span class="text-uppercase text-primary bg-light- px-2-">Choose Us</span>
                </h1>

                <h3 class="mb-3">Designing Interiors That Inspire Everyday Living</h3>
                <p class="mb-5">
                    From concept to creation, every space we design reflects beauty, balance, and purpose.
                    Be it your home, office, or retail space, we transform it into an inspiring environment.
                </p>
            </div>
            <div class="row g-5 align-items-center text-center">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-lightbulb fa-5x text-primary mb-4"></i>
                    <h4>Creative Concepts</h4>
                    <p class="mb-0">Unique, customized designs that match your lifestyle and personal taste.</p>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-award fa-5x text-primary mb-4"></i>
                    <h4>Quality Execution</h4>
                    <p class="mb-0">Attention to detail in every material and finish, ensuring perfection in every
                        space.</p>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-truck fa-5x text-primary mb-4"></i>
                    <h4>On-Time Delivery</h4>
                    <p class="mb-0">Reliable project timelines with transparent communication throughout the process.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Choose Us End -->

    <!-- Gallery Start -->
    <div class="container-fluid py-4" id="services">
        <div class="container py-4">
            <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-3">
                    <span class="text-uppercase text-primary bg-white px-2">Segments</span>
                </h1>
                <p class="mb-0">
                    At <strong>Tridents Interior Solution</strong>, we turn your dream space into reality blending
                    luxury, functionality,
                    and modern aesthetics that reflect your personality.
                </p>
            </div>
            <div class="text-center mb-4 wow fadeIn" data-wow-delay="0.2s">
                <button class="btn btn-primary mx-2 filter-btn active" data-filter="all">All</button>
                <button class="btn btn-outline-primary mx-2 filter-btn" data-filter="residential">Residential</button>
                <button class="btn btn-outline-primary mx-2 filter-btn" data-filter="commercial">Commercial</button>
                <!--<button class="btn btn-outline-primary mx-2 filter-btn" data-filter="turnkey">Turnkey</button>-->

            </div>
            <div class="row g-4" id="serviceGallery">
                <!-- <div class="col-md-6 col-lg-3 filter-item residential wow fadeIn" data-wow-delay="0.1s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/r1.jpg" class="img-fluid w-100" alt="Residential Design">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-couch text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Living Room</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 filter-item residential wow fadeIn" data-wow-delay="0.2s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/r2.jpg" class="img-fluid w-100" alt="Home Renovation">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-bed text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Bedroom</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 filter-item residential wow fadeIn" data-wow-delay="0.3s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/r3.jpg" class="img-fluid w-100" alt="Office Interiors">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-utensils text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Kitchen</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 filter-item residential wow fadeIn" data-wow-delay="0.4s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/r4.jpg" class="img-fluid w-100" alt="Retail Design">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-building text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Hall</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> -->
                <?php foreach ($residential_data as $k => $row): ?>
                <div class="col-md-6 col-lg-3 filter-item residential wow fadeIn" data-wow-delay="<?php echo 0.1+($k*0.1); ?>s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="<?php echo 'admin/'.htmlspecialchars($row['image']); ?>" class="img-fluid w-100" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa <?php echo htmlspecialchars($row['icon_class']); ?> text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase"><?php echo htmlspecialchars($row['title']); ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- <div class="col-md-6 col-lg-3 filter-item commercial wow fadeIn" data-wow-delay="0.4s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/c1.jpg" class="img-fluid w-100" alt="Retail Design">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-briefcase text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Office</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 filter-item commercial wow fadeIn" data-wow-delay="0.4s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/c2.jpg" class="img-fluid w-100" alt="Retail Design">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-store text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Retail & Showroom</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 filter-item commercial wow fadeIn" data-wow-delay="0.4s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/c3.jpg" class="img-fluid w-100" alt="Retail Design">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-mug-hot text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Restaurant & Café</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 filter-item commercial wow fadeIn" data-wow-delay="0.4s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/segment/c4.jpg" class="img-fluid w-100" alt="Retail Design">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-glass-cheers text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Club House</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> -->
                <?php foreach ($commercial_data as $k => $row): ?>
                <div class="col-md-6 col-lg-3 filter-item commercial wow fadeIn" data-wow-delay="<?php echo 0.4+($k*0.1); ?>s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="<?php echo 'admin/'.htmlspecialchars($row['image']); ?>" class="img-fluid w-100" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa <?php echo htmlspecialchars($row['icon_class']); ?> text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase"><?php echo htmlspecialchars($row['title']); ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Turnkey Items 
                <div class="col-md-6 col-lg-3 filter-item turnkey wow fadeIn" data-wow-delay="0.1s">
                    <div class="service-card shadow-sm">
                        <div class="image-wrapper">
                            <a href="/portfolio">
                                <img src="img/Segment/turnkey-1.jpg" class="img-fluid w-100" alt="Turnkey Interior">
                                <div class="card-overlay">
                                    <div class="overlay-content text-center">
                                        <i class="fa fa-tools text-white mb-2 fs-4"></i>
                                        <h6 class="text-white text-uppercase">Complete Interior Setup</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <!-- Gallery End -->


    <!-- Service Start -->
    <?php if(!empty($ourservices)): ?>
    <div class="container-fluid ">
        <div class="container py-4" id="services">
            <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
                <h1>Our <span class="text-primary">Services</span></h1>
                <p class="mb-0">
                    We offer end-to-end interior solutions that blend creativity, functionality, and elegance to
                    transform spaces into inspiring environments.
                </p>

            </div>
            <div class="row g-4 justify-content-center">
                <?php foreach($ourservices as $k => $row): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="text-center">
                            <img src="<?php echo 'admin/'.$row['image']; ?>" class="img-fluid rounded shadow-sm mb-3"
                                alt="<?php echo $row['title']; ?>">
                            <h6 class="fw-semibold"><?php echo $row['title']; ?></h6>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Service Item -->
                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-1.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Turnkey Interior Solutions">
                        <h6 class="fw-semibold">Turnkey Interior Solutions</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-2.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Modular Kitchens">
                        <h6 class="fw-semibold">Modular Kitchens</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-3.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Custom Furniture">
                        <h6 class="fw-semibold">Custom Furniture</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-4.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="False Ceiling">
                        <h6 class="fw-semibold">False Ceiling</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-5.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Flooring">
                        <h6 class="fw-semibold">Flooring</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-6.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Lighting">
                        <h6 class="fw-semibold">Lighting</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-7.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Office Furniture">
                        <h6 class="fw-semibold">Office Furniture</h6>
                    </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/services/service-8.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Curtain / Blinds">
                        <h6 class="fw-semibold">Curtain / Blinds</h6>
                    </div>
                </div> -->
            </div>

            <div class="text-center mt-5">
                <a href="/residential" class="btn btn-primary px-4 py-2">
                    View More Services <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- Service End -->

    <!-- Testimonials Start -->
    <?php if(!empty($testimonials)): ?>
    <div class="container-fluid py-4">
        <div class="container py-4">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
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
                                class="text-uppercase text-primary bg-white- px-2-">Newsletter</span></h1>
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

    <!-- Filter Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll(".filter-btn");
            const items = document.querySelectorAll(".filter-item");

            buttons.forEach(btn => {
                btn.addEventListener("click", () => {
                    // Button Active Effect
                    buttons.forEach(b => b.classList.remove("active", "btn-primary"));
                    buttons.forEach(b => b.classList.add("btn-outline-primary"));
                    btn.classList.add("active", "btn-primary");
                    btn.classList.remove("btn-outline-primary");

                    const filter = btn.getAttribute("data-filter");

                    items.forEach(item => {
                        if (filter === "all" || item.classList.contains(filter)) {
                            item.style.display = "block";
                            item.classList.add("fade-in");
                        } else {
                            item.style.display = "none";
                            item.classList.remove("fade-in");
                        }
                    });
                });
            });
        });
    </script>

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