<div class="container-fluid bg-dark text-white-50 footer pt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <a href="/" class="d-inline-block mb-3">
                    <!-- <h1 class="text-white">Tridents</h1> -->
                    <?php if(!empty($settings['site_logo'])) : ?>
                        <img src="<?php echo 'admin/'.$settings['site_logo']; ?>" alt="TRIDENTS" height="46" style="max-width:200px;">
                    <?php else: ?>
                        <h1 class="text-white">Tridents</h1>
                    <?php endif; ?>
                </a>
                <p style="text-align: justify;" class="mb-0">We bring creativity, craftsmanship, and class together
                    to design spaces that reflect
                    who you are.</p>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <h5 class="text-white mb-4">Contact</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i><?php echo (!empty($settings['site_address'])?$settings['site_address']:'Demo Street, Demo City, Demo Country'); ?></p>
                <p><i class="fa fa-phone-alt me-3"></i><?php echo (!empty($settings['site_phone'])?$settings['site_phone']:'+1 555 123 4567'); ?></p>
                <p><i class="fa fa-envelope me-3"></i><?php echo (!empty($settings['site_email'])?$settings['site_email']:'demo@example.com'); ?></p>

            </div>

            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <h5 class="text-white mb-4">Quick Links</h5>
                <a class="btn btn-link" href="/about">About Us</a>
                <a class="btn btn-link" href="/service">Services</a>
                <a class="btn btn-link" href="/portfolio">Gallery</a>
                <a class="btn btn-link" href="/contact">Contact Us</a>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <h5 class="text-white mb-4">Follow Us</h5>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="<?php echo (!empty($settings['facebook_url'])?$settings['facebook_url']:'#!'); ?>"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="<?php echo (!empty($settings['youtube_url'])?$settings['youtube_url']:'#!'); ?>"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="<?php echo (!empty($settings['instagram_url'])?$settings['instagram_url']:'#!'); ?>"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright -->
    <div class="container wow fadeIn" data-wow-delay="0.1s">
        <div class="copyright py-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    &copy; <span id="year"></span> <a class="border-bottom" href="/"><?php echo (!empty($settings['site_name'])?$settings['site_name']:'Tridents - Interior Solution'); ?></a>. All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</div>