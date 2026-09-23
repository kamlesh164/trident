<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';
$admin_id = $_SESSION['admin_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password_query = '';
    if (!empty($_POST['new_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM users WHERE id=$admin_id"));

        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $password_query = " password='$hashed_password'";
            } else {
                $_SESSION['error'] = 'New passwords do not match!';
                header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
                exit;
            }
        } else {
            $_SESSION['error'] = 'Current password is incorrect!';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        }
    }

    if (empty($error)) {
        $query = "UPDATE users SET $password_query WHERE id=$admin_id";

        if (mysqli_query($conn, $query)) {
            $_SESSION['admin_username'] = $username;
            $_SESSION['success'] = 'Profile updated successfully!';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        } else {
            $_SESSION['error'] = 'Error updating profile: ' . mysqli_error($conn);
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        }
    }
}

if (!empty($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$admin_id"));
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items['admin-profile']['icon'] ?>"></i> <?php echo $menu_items['admin-profile']['title']; ?></h1>
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

    <div class="row">
        <!-- <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <?php if ($admin['profile_image']): ?>
                        <img src="<?php echo $admin['profile_image']; ?>" alt="Profile" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px; font-size: 4rem;">
                            <?php echo strtoupper(substr($admin['full_name'], 0, 1)); ?>
                        </div>
                    <?php endif; ?>

                    <h4 class="mb-3"><?php echo htmlspecialchars($admin['full_name']); ?></h4>
                    <p class="text-muted">@<?php echo htmlspecialchars($admin['username']); ?></p>
                    <p class="text-muted"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($admin['email']); ?></p>

                    <hr>

                    <div class="text-start">
                        <p class="mb-2"><strong>Account Created:</strong></p>
                        <p class="text-muted"><?php echo date('F d, Y', strtotime($admin['created_at'])); ?></p>

                        <p class="mb-2 mt-3"><strong>Last Updated:</strong></p>
                        <p class="text-muted"><?php echo date('F d, Y H:i', strtotime($admin['updated_at'])); ?></p>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-lg-12">
            <!-- Edit Profile Form -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Edit Profile
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <!-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($admin['full_name']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*" data-preview="preview_profile">
                            <img id="preview_profile" class="image-preview mt-2" style="display: none;">
                        </div>

                        <hr class="my-4"> -->

                        <h5 class="mb-3">Change Password</h5>

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>

</body>
</html>
