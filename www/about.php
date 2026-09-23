<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$about = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_page WHERE section='about' AND item_type='main' LIMIT 1"));
// Select Vision Title & List
$vision_title_row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT title FROM about_page WHERE section='vision' AND item_type='main' LIMIT 1"));
$vision_title = $vision_title_row ? $vision_title_row['title'] : '';
$vision_lists = [];
$res = mysqli_query($conn,"SELECT * FROM about_page WHERE section='vision' AND item_type='list' ORDER BY order_no ASC, id ASC");
while($row = mysqli_fetch_assoc($res)) $vision_lists[] = $row;
// Select Mission Title & List
$mission_title_row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT title FROM about_page WHERE section='mission' AND item_type='main' LIMIT 1"));
$mission_title = $mission_title_row ? $mission_title_row['title'] : '';
$mission_lists = [];
$res = mysqli_query($conn,"SELECT * FROM about_page WHERE section='mission' AND item_type='list' ORDER BY order_no ASC, id ASC");
while($row = mysqli_fetch_assoc($res)) $mission_lists[] = $row;
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
    <div class="container-fluid pb-3 bg-dark- hero-header">
        <div class="container py-4">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-1 mb-0 animated slideInLeft">About</h1>
                </div>
                <div class="col-lg-6 animated slideInRight">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Pages</a></li>
                            <li class="breadcrumb-item text-secondary active" aria-current="page">About</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Image Section -->
                 <?php if($about && $about['image']): ?>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid h-100 rounded-3" style="object-fit: cover;" src="<?php echo 'admin/'.$about['image']; ?>"
                        alt="Tridents Interior Solutions">
                </div>
                <?php endif; ?>

                <!-- About Content -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-3">
                        <span class="text-uppercase text-primary bg-light- px-2-">About Us</span>
                    </h1>

                    <?php if($about && $about['title']): ?>
                        <h3 class="mb-3"><?php echo $about['title']; ?></h3>
                    <?php endif; ?>

                    <?php if($about && $about['description']): ?>
                    <p class="mb-3" style="text-align: justify;">
                        <?php echo nl2br(htmlspecialchars($about['description'])); ?>
                    </p>
                    <?php endif; ?>

                    <div>
                        <a class="btn btn-primary px-4 me-2" href="/residential">View Our Services
                            <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="row mt-5 g-4">
                <!-- Vision -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa fa-eye fa-lg"></i>
                                </div>
                                <h5 class="card-title mb-0 fw-bold text-uppercase">Our Vision</h5>
                            </div>
                            <?php if(!empty($vision_title)): ?>
                            <p class="card-text text-muted" style="text-align: justify;">
                                <?= htmlspecialchars($vision_title) ?>
                            </p>
                            <?php endif; ?>
                            <?php if(!empty($vision_lists)): ?>
                                <ul class="list-unstyled mt-3 mb-0">
                                <?php foreach($vision_lists as $k => $v): ?>
                                    <li<?php if($k !== array_key_last($vision_lists)) echo ' class="mb-2"'; ?>>
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        <?= htmlspecialchars($v['list_text']); ?>
                                    </li>
                                    <!-- <li class="mb-2">
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        Inspire through thoughtful, innovative design.
                                    </li>
                                    <li class="mb-2">
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        Set benchmarks in quality, functionality, and aesthetics.
                                    </li>
                                    <li>
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        Lead with integrity, creativity, and client-centric solutions.
                                    </li> -->
                                
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Mission -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa fa-rocket fa-lg"></i>
                                </div>
                                <h5 class="card-title mb-0 fw-bold text-uppercase">Our Mission</h5>
                            </div>
                            <?php if(!empty($mission_title)): ?>
                            <p class="card-text text-muted" style="text-align: justify;">
                                <?= htmlspecialchars($mission_title) ?>
                            </p>
                            <?php endif; ?>
                            <?php if(!empty($mission_lists)): ?>
                                <ul class="list-unstyled mt-3 mb-0">
                                <?php foreach($mission_lists as $k => $m): ?>
                                    <li<?php if($k !== array_key_last($mission_lists)) echo ' class="mb-2"'; ?>>
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        <?= htmlspecialchars($m['list_text']); ?>
                                    </li>
                                <!-- <ul class="list-unstyled mt-3 mb-0">
                                    <li class="mb-2">
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        Provide personalized, cost-effective design solutions.
                                    </li>
                                    <li class="mb-2">
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        Uphold quality, transparency, and trust in every project.
                                    </li>
                                    <li>
                                        <i class="fa fa-check-circle text-primary me-2"></i>
                                        Continuously innovate to meet evolving trends and client needs.
                                    </li>
                                </ul> -->
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



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