<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if ($key != 'action') {
            $setting_key = mysqli_real_escape_string($conn, $key);
            $setting_value = mysqli_real_escape_string($conn, $value);

            $check = mysqli_query($conn, "SELECT id FROM site_settings WHERE setting_key='$setting_key'");

            if (mysqli_num_rows($check) > 0) {
                
                mysqli_query($conn, "UPDATE site_settings SET setting_value='$setting_value' WHERE setting_key='$setting_key'");
            } else {
                
                mysqli_query($conn, "INSERT INTO site_settings (setting_key, setting_value) VALUES ('$setting_key', '$setting_value')");
            }
        }
    }

    if (isset($_FILES['site_logo']) && $_FILES['site_logo']['error'] == 0) {
        $upload_dir = 'uploads/settings/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_extension = pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
        $new_filename = 'logo_' . time() . '.' . $file_extension;
        $upload_path = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['site_logo']['tmp_name'], $upload_path)) {
            $old_logo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT setting_value FROM site_settings WHERE setting_key='site_logo'"))['setting_value'];
            if ($old_logo && file_exists($old_logo)) unlink($old_logo);

            mysqli_query($conn, "UPDATE site_settings SET setting_value='$upload_path' WHERE setting_key='site_logo'");
        }
        else{
            $_SESSION['error'] = 'Logo upload failed!';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        }
    }

    $_SESSION['success'] = 'Settings updated successfully!';
    header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
    exit;
}
if (!empty($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$settings = [];
$result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items['site-settings']['icon'] ?>"></i> <?php echo $menu_items['site-settings']['title']; ?></h1>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-sliders-h"></i> General Settings
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" 
                               value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="site_email" class="form-label">Site Email</label>
                        <input type="email" class="form-control" id="site_email" name="site_email" 
                               value="<?php echo htmlspecialchars($settings['site_email'] ?? ''); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="site_phone" class="form-label">Contact Phone</label>
                        <input type="text" class="form-control" id="site_phone" name="site_phone" 
                               value="<?php echo htmlspecialchars($settings['site_phone'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="site_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="site_address" name="site_address" 
                               value="<?php echo htmlspecialchars($settings['site_address'] ?? ''); ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="site_description" class="form-label">Site Description</label>
                    <textarea class="form-control" id="site_description" name="site_description" rows="3"><?php echo htmlspecialchars($settings['site_description'] ?? ''); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="site_logo" class="form-label">Site Logo</label>
                    <?php if (isset($settings['site_logo']) && file_exists(__DIR__ . '/' .$settings['site_logo'])): ?>
                        <div class="mb-2">
                            <img src="<?php echo $settings['site_logo']; ?>" alt="Current Logo" style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*" data-preview="logo_preview">
                    <img id="logo_preview" class="image-preview mt-2" style="display: none;">
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Social Media Links</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="facebook_url" class="form-label">
                            <i class="fab fa-facebook"></i> Facebook URL
                        </label>
                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                               value="<?php echo htmlspecialchars($settings['facebook_url'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="instagram_url" class="form-label">
                            <i class="fab fa-instagram"></i> Instagram URL
                        </label>
                        <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                               value="<?php echo htmlspecialchars($settings['instagram_url'] ?? ''); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="youtube_url" class="form-label">
                            <i class="fab fa-youtube"></i> Youtube URL
                        </label>
                        <input type="url" class="form-control" id="youtube_url" name="youtube_url" 
                               value="<?php echo htmlspecialchars($settings['youtube_url'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="linkedin_url" class="form-label">
                            <i class="fab fa-linkedin"></i> LinkedIn URL
                        </label>
                        <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                               value="<?php echo htmlspecialchars($settings['linkedin_url'] ?? ''); ?>">
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">SEO Settings</h5>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                           value="<?php echo htmlspecialchars($settings['meta_keywords'] ?? ''); ?>">
                    <small class="text-muted">Separate keywords with commas</small>
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2"><?php echo htmlspecialchars($settings['meta_description'] ?? ''); ?></textarea>
                </div>

                <!-- <hr class="my-4">

                <div class="mb-3">
                    <label for="footer_text" class="form-label">Footer Text</label>
                    <input type="text" class="form-control" id="footer_text" name="footer_text" 
                           value="<?php echo htmlspecialchars($settings['footer_text'] ?? ''); ?>">
                </div> -->

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>

</body>
</html>
