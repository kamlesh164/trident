<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$services = [];
$sql = mysqli_query($conn, "SELECT * FROM services WHERE category = 'residential' ORDER BY created_at ASC");
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        $services[] = $row;
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

    <!-- Residential Interior Services Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">
                    <span class="text-uppercase text-primary bg-light- px-2-">Residential</span> Interior Solutions
                </h1>
                <p class="mb-5">
                    Transform your home into a masterpiece of comfort and style. At Tridents, we create interiors that
                    perfectly balance elegance, functionality, and your personal lifestyle.
                </p>
            </div>
            <div class="row g-4">
                <!-- Service Item 1 -->
                <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="img/services/residential-1.jpg" alt="Luxury Living Room Design">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">Luxury Living Room Design</h4>
                            <p class="text-muted">
                                Create inviting living spaces with timeless elegance, seamless lighting, and bespoke
                                furnishings that balance comfort and sophistication for family and guests.
                            </p>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 2 -->
                <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="img/services/residential-2.jpg" alt="Elegant Bedroom Interiors">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">Elegant Bedroom Interiors</h4>
                            <p class="text-muted">
                                Personalized bedroom designs that evoke serenity and luxury, creating a tranquil
                                sanctuary tailored to your lifestyle and aesthetic preferences.
                            </p>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 3 -->
                <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="img/services/residential-3.jpg" alt="Modern Modular Kitchens">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">Modern Modular Kitchens</h4>
                            <p class="text-muted">
                                Sleek, space-efficient kitchen layouts designed for both functionality and style,
                                offering effortless cooking experiences and a refined entertaining environment.
                            </p>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 4 -->
                <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="img/services/residential-4.jpg" alt="Creative Kids Room Design">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">Creative Kids Room Design</h4>
                            <p class="text-muted">
                                Vibrant, safe, and imaginative spaces that nurture creativity, learning, and play —
                                designed to inspire and delight children in every corner.
                            </p>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 5 -->
                <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="img/services/residential-5.jpg" alt="Bedroom Dressing & Storage Solutions">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">Bedroom Dressing & Storage</h4>
                            <p class="text-muted">
                                Stylish and functional bedroom dressing areas with smart storage solutions, combining
                                elegance and practicality to make daily routines effortless and organized.
                            </p>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 6 -->
                <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.1s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="img/services/residential-6.jpg" alt="Elegant Dining & Entertainment Spaces">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">Living & Entertainment Hall</h4>
                            <p class="text-muted">
                                Expansive and elegant hall spaces designed for family gatherings, social events, and
                                entertainment — combining comfort, style, and functionality to create memorable
                                experiences.
                            </p>
                        </div>
                    </div>
                </div> -->

                <?php if(count($services) > 0): ?>
                <?php foreach($services as $service): ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.1s">
                    <div class="card border-0 shadow-sm h-100 service-card">
                        <div class="square-img">
                            <img src="<?php echo 'admin/'.$service['image']; ?>" alt="<?php echo $service['title']; ?>">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary"><?php echo $service['title']; ?></h4>
                            <p class="text-muted">
                                <?php echo $service['description']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- Residential Interior Services End -->



    <style>
        .service-card {
            transition: all 0.4s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        /* Square Image Container */
        .square-img {
            width: 100%;
            padding-top: 100%;
            /* 1:1 aspect ratio */
            position: relative;
            overflow: hidden;
        }

        .square-img img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .service-card:hover img {
            transform: scale(1.1);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .text-muted {
            text-align: justify;
        }
    </style>




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