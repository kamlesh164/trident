<?php
$current = $_SERVER['REQUEST_URI'];
function nav_active($slugArr) {
    global $current;
    foreach($slugArr as $slug) {
        if($slug === 'home'){ return ( $current === '/' ) ? 'active' : ''; }
        if (strpos($current, $slug) !== false) return 'active';
    }
    return '';
}
?>
<div class="container-fluid sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light border-2 header-border-bottom">
            <a href="/" class="navbar-brand">
                <?php if(!empty($settings['site_logo'])) : ?>
                    <img src="<?php echo 'admin/'.$settings['site_logo']; ?>" alt="TRIDENTS" height="46" style="max-width:200px;">
                <?php else: ?>
                    <h1>TRIDENTS</h1>
                <?php endif; ?>
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="/" class="nav-item nav-link <?= nav_active(['home']) ?>">Home</a>
                    <a href="/about" class="nav-item nav-link <?= nav_active(['about']) ?>">About Us</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?=
                            nav_active(['residential', 'commertial', 'turnkey'])
                        ?>" data-bs-toggle="dropdown">Services</a>
                        <div class="dropdown-menu bg-light-dropdown mt-2">
                            <a href="/residential" class="dropdown-item <?= nav_active(['residential']) ?>">Residential Interior</a>
                            <a href="/commertial" class="dropdown-item <?= nav_active(['commertial']) ?>">Commercial Interior</a>
                            <a href="/turnkey" class="dropdown-item <?= nav_active(['turnkey']) ?>">Turnkey Interior</a>
                        </div>
                    </div>
                    <a href="/portfolio" class="nav-item nav-link <?= nav_active(['portfolio']) ?>">Portfolio</a>
                    <a href="/contact" class="nav-item nav-link <?= nav_active(['contact']) ?>">Contact Us</a>
                </div>
            </div>
        </nav>
    </div>
</div>