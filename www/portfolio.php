<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$arrImage = [];
$images = mysqli_query($conn, "SELECT * FROM gallery_items WHERE type = 'portfolio' ORDER BY display_order");
while ($row = mysqli_fetch_assoc($images)) {
    $arrImage[$row['display_order']] = $row['image_path'];
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
    <style>
        /* Only gallery images hover effect */
        .gallery-row img:hover {
            transform: scale(1.05);
            transition: 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
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
                    <h1 class="display-1 mb-0 animated slideInLeft">Portfolio</h1>
                </div>
                <div class="col-lg-6 animated slideInRight">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Pages</a></li>
                            <li class="breadcrumb-item text-secondary active" aria-current="page">Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Feature Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">Our Latest <span class="text-uppercase text-primary bg-light- px-2-">Portfolio</span>
                </h1>
                <p class="mb-5">Showcasing our finest Residential, Commercial, and Turnkey interior projects crafted
                    with creativity and precision.</p>

            </div>
            <div class="row g-4 justify-content-center gallery-row">
                <!-- Service Item -->
                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-1.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Turnkey Interior Solutions"> -->
                        <!--<h6 class="fw-semibold">Turnkey Interior Solutions</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-2.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Modular Kitchens"> -->
                        <!--<h6 class="fw-semibold">Modular Kitchens</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-3.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Custom Furniture"> -->
                        <!--<h6 class="fw-semibold">Custom Furniture</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-4.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="False Ceiling"> -->
                        <!--<h6 class="fw-semibold">False Ceiling</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-5.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Flooring"> -->
                        <!--<h6 class="fw-semibold">Flooring</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-6.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Lighting"> -->
                        <!--<h6 class="fw-semibold">Lighting</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-7.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Office Furniture"> -->
                        <!--<h6 class="fw-semibold">Office Furniture</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-8.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Curtain / Blinds"> -->
                        <!--<h6 class="fw-semibold">Curtain / Blinds</h6>-->
                    <!-- </div>
                </div> -->
                <!-- Service Item -->
                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-9.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Turnkey Interior Solutions"> -->
                        <!--<h6 class="fw-semibold">Turnkey Interior Solutions</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-10.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Modular Kitchens"> -->
                        <!--<h6 class="fw-semibold">Modular Kitchens</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-11.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Custom Furniture"> -->
                        <!--<h6 class="fw-semibold">Custom Furniture</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-12.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="False Ceiling"> -->
                        <!--<h6 class="fw-semibold">False Ceiling</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-13.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Flooring"> -->
                        <!--<h6 class="fw-semibold">Flooring</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-14.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Lighting"> -->
                        <!--<h6 class="fw-semibold">Lighting</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-15.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Office Furniture"> -->
                        <!--<h6 class="fw-semibold">Office Furniture</h6>-->
                    <!-- </div>
                </div> -->

                <!-- <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-16.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Curtain / Blinds"> -->
                        <!--<h6 class="fw-semibold">Curtain / Blinds</h6>-->
                    <!-- </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-17.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Flooring"> -->
                        <!--<h6 class="fw-semibold">Flooring</h6>-->
                    <!-- </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-18.jpg" class="img-fluid rounded shadow-sm mb-3" alt="Lighting"> -->
                        <!--<h6 class="fw-semibold">Lighting</h6>-->
                    <!-- </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-19.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Office Furniture"> -->
                        <!--<h6 class="fw-semibold">Office Furniture</h6>-->
                    <!-- </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="img/gallery/gallery-20.jpg" class="img-fluid rounded shadow-sm mb-3"
                            alt="Curtain / Blinds"> -->
                        <!--<h6 class="fw-semibold">Curtain / Blinds</h6>-->
                    <!-- </div>
                </div> -->
                <?php if (!empty($arrImage)) {
                    foreach ($arrImage as $order => $imagePath) { ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="text-center">
                        <img src="<?php echo 'admin/'.$imagePath; ?>" class="img-fluid rounded shadow-sm mb-3"
                            alt="Portfolio Image <?php echo $order; ?>">
                    </div>  
                </div>      
                <?php }
                } ?>
            </div>
        </div>
    </div>
    <!-- Portfolio Gallery End -->
    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- modal-sm for small size -->
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <img src="" class="img-fluid w-100" id="modalImage" alt="Gallery Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include_once 'footer.php'; ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#!" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll('.row img'); // Select all gallery images
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');

            images.forEach(img => {
                img.style.cursor = 'pointer'; // show clickable cursor
                img.addEventListener('click', function () {
                    modalImage.src = this.src; // set modal image
                    modal.show(); // open modal
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