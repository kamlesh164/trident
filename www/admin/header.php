<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/static_data.php';

$logo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT setting_value FROM site_settings WHERE setting_key='site_logo'"))['setting_value'];
$fav_logo = '';
if ($logo && file_exists($logo)){
    $fav_logo = $logo;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace('-', ' ', $current_page)); ?> - Tridents Admin</title>
    <link href="/favicon.ico?v=1" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-white me-3 d-lg-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand" href="dashboard">
                <?php if(!empty($fav_logo)) : ?>
                    <img src="<?php echo $fav_logo; ?>" alt="TRIDENTS" height="46" style="max-width:200px;">
                <?php else: ?>
                    <i class="fas fa-shield-alt"></i> TRIDENTS
                <?php endif; ?>
                
            </a>

            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-link primary-color dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i>
                        <span class="ms-2 d-none d-md-inline"><?php echo $_SESSION['admin_name'] ?? 'Admin'; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="admin-profile"><i class="fas fa-user"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="site-settings"><i class="fas fa-cog"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
