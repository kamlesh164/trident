<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';
$type = 'testimonial';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $star = floatval($_POST['star']); // float for .5 steps
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "uploads/$type/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $new_filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $image_path = $upload_path;
        }
    }

    if ($_POST['action'] == 'add') {
        if ($image_path) {
            $query = "INSERT INTO testimonials (name, designation, title, description, image, star, city, status) VALUES ('$name', '$designation', '$title', '$description', '$image_path', '$star', '$city', '$status')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = 'Testimonial added successfully!';
                header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
                exit;
            } else {
                $_SESSION['error'] = 'Error adding testimonial: ' . mysqli_error($conn);
                header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
                exit;
            }
        } else {
            $_SESSION['error'] = 'Please upload an image.';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        }
    } elseif ($_POST['action'] == 'edit') {
        $id = intval($_POST['id']);
        if ($image_path) {
            $old_img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM testimonials WHERE id=$id"))['image'];
            if (file_exists($old_img)) unlink($old_img);
            $query = "UPDATE testimonials SET name='$name', designation='$designation', title='$title', description='$description', image='$image_path', star='$star', city='$city', status='$status' WHERE id=$id";
        } else {
            $query = "UPDATE testimonials SET name='$name', designation='$designation', title='$title', description='$description', star='$star', city='$city', status='$status' WHERE id=$id";
        }
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Testimonial updated successfully!';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        } else {
            $_SESSION['error'] = 'Error updating testimonial: ' . mysqli_error($conn);
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM testimonials WHERE id=$id"))['image'];
    if (mysqli_query($conn, "DELETE FROM testimonials WHERE id=$id")) {
        if (file_exists($img)) unlink($img);
        $_SESSION['success'] = 'Testimonial deleted successfully!';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    } else {
        $_SESSION['error'] = 'Error deleting testimonial.';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    }
}

if (!empty($_SESSION['success'])) { $success = $_SESSION['success']; unset($_SESSION['success']); }
if (!empty($_SESSION['error'])) { $error = $_SESSION['error']; unset($_SESSION['error']); }

$testimonials = [];
$sql = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY created_at DESC");
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        $testimonials[] = $row;
    }
}
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items[$type]['icon'] ?>"></i> <?php echo $menu_items[$type]['title']; ?></h1>
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

    <div class="mb-3">
        <button class="btn btn-primary testimonial-add-btn" data-bs-toggle="modal" data-bs-target="#testimonialModal">
            <i class="fas fa-plus"></i> Add New Testimonial
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> All Testimonials
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Stars</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (count($testimonials) > 0) {
                        $index = 1;
                        foreach ($testimonials as $row) { ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><img src="<?php echo $row['image']; ?>" alt="Image" style="width: 60px; height: 45px; object-fit: cover;"></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td>
                                <?php
                                $starValue = floatval($row['star']);
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($starValue >= $i) {
                                        echo '<i class="fas fa-star text-warning"></i> ';
                                    } elseif ($starValue == ($i - 0.5)) {
                                        echo '<i class="fas fa-star-half-alt text-warning"></i> ';
                                    } else {
                                        echo '<i class="far fa-star text-secondary"></i> ';
                                    }
                                }
                                ?>
                            </td>
                            <td class="action-buttons">
                                <button class="btn btn-sm btn-warning testimonial-edit-btn"
                                    data-id="<?php echo $row['id']; ?>"
                                    data-name="<?php echo htmlspecialchars($row['name']); ?>"
                                    data-designation="<?php echo htmlspecialchars($row['designation']); ?>"
                                    data-title="<?php echo htmlspecialchars($row['title']); ?>"
                                    data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                    data-star="<?php echo $row['star']; ?>"
                                    data-city="<?php echo htmlspecialchars($row['city']); ?>"
                                    data-status="<?php echo $row['status']; ?>"
                                    data-image="<?php echo $row['image']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger delete-btn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php $index++; } } else { ?>
                        <tr>
                            <td colspan="8" class="text-center">No testimonials found. Please add your first testimonial!</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testimonialModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="testimonialForm">
                <input type="hidden" name="action" id="modal_action" value="">
                <input type="hidden" name="id" id="modal_id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="modal_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="modal_name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal_designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="modal_designation" name="designation">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="modal_title" name="title" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="modal_description" class="form-label">Description</label>
                            <textarea class="form-control" id="modal_description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="modal_city" name="city">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal_star" class="form-label">Stars</label>
                            <select class="form-select" id="modal_star" name="star" required>
                                <option value="5">★★★★★</option>
                                <option value="4.5">★★★★½</option>
                                <option value="4">★★★★</option>
                                <option value="3.5">★★★½</option>
                                <option value="3">★★★</option>
                                <option value="2.5">★★½</option>
                                <option value="2">★★</option>
                                <option value="1.5">★½</option>
                                <option value="1">★</option>
                                <option value="0.5">½</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="modal_image" name="image" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal_status" class="form-label">Status</label>
                            <select class="form-select" id="modal_status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="modal_submit_btn"></button>
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
