<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';
$category = 'residential';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $icon_class = mysqli_real_escape_string($conn, $_POST['icon_class']);

    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "uploads/$category/";
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
            $query = "INSERT INTO services (title, description, image, status, category, icon_class) VALUES ('$title', '$description', '$image_path', '$status', '$category', '$icon_class')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = 'Residential service added successfully!';
                header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
                exit;
            } else {
                $_SESSION['error'] = 'Error adding service: ' . mysqli_error($conn);
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
            $old_img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM services WHERE id=$id AND category = '$category'"))['image'];
            if (file_exists($old_img)) unlink($old_img);

            $query = "UPDATE services SET title='$title', description='$description', image='$image_path', status='$status', icon_class='$icon_class' WHERE id=$id AND category = '$category'";
        } else {
            $query = "UPDATE services SET title='$title', description='$description', status='$status', icon_class='$icon_class' WHERE id=$id AND category = '$category'";
        }

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Residential service updated successfully!';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        } else {
            $_SESSION['error'] = 'Error updating service: ' . mysqli_error($conn);
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM services WHERE id=$id AND category = '$category'"))['image'];

    if (mysqli_query($conn, "DELETE FROM services WHERE id=$id AND category = '$category'")) {
        if (file_exists($img)) unlink($img);
        $_SESSION['success'] = 'Service deleted successfully!';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    } else {
        $_SESSION['error'] = 'Error deleting service.';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
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

$services = [];
$sql = mysqli_query($conn, "SELECT * FROM services WHERE category = '$category' ORDER BY created_at DESC");
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        $services[] = $row;
    }
}
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items['residential']['icon'] ?>"></i> <?php echo $menu_items['residential']['title']; ?></h1>
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

    <!-- Add New Button -->
    <div class="mb-3">
        <button class="btn btn-primary add-btn" data-bs-toggle="modal" data-category="<?php echo $category ?>" data-bs-target="#serviceModal">
            <i class="fas fa-plus"></i> Add New Service
        </button>
    </div>

    <!-- Services Table -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> All Residential Services
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Icon</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($services) > 0) {
                            $index = 1;
                            foreach ($services as $key => $row) { ?>
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td><img src="<?php echo $row['image']; ?>" alt="Image" style="width: 80px; height: 60px; object-fit: cover;"></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><i class="fas <?php echo (!empty($row['icon_class'])?$row['icon_class']:'fa-minus'); ?>"></i></td>
                                <td>
                                    <?php
                                    $desc = htmlspecialchars($row['description']);
                                    if (strlen($desc) > 50) {
                                        echo substr($desc, 0, 50) . '...';
                                    } else {
                                        echo $desc;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $row['status'] == 'active' ? 'success' : 'secondary'; ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-warning edit-btn"
                                        data-id="<?php echo $row['id']; ?>"
                                        data-title="<?php echo htmlspecialchars($row['title']); ?>"
                                        data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                        data-status="<?php echo $row['status']; ?>"
                                        data-image="<?php echo $row['image']; ?>"
                                        data-category="<?php echo $row['category']; ?>"
                                        data-icon_class="<?php echo $row['icon_class']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php $index++; }
                        }else { ?>
                            <tr>
                                <td colspan="7" class="text-center">No services found. Add your first service!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="serviceForm">
                <input type="hidden" name="action" id="modal_action" value="">
                <input type="hidden" name="id" id="modal_id">
                <input type="hidden" name="category" id="modal_category" value="<?php echo $category ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="modal_title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="modal_description" class="form-label">Description</label>
                        <textarea class="form-control" id="modal_description" name="description" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="modal_icon_class" class="form-label">Icon Class
                            <a href="https://fontawesome.com/icons" target="_blank" style="font-size:0.9em;">(Find icon)</a>
                        </label>
                        <input type="text" class="form-control" id="modal_icon_class" name="icon_class" placeholder="fa-bed" autocomplete="off">
                        <span id="iconPreview" style="font-size:2em;vertical-align:middle;"></span>
                    </div>
                    <div class="mb-3" id="current_img_box" style="display: none;">
                        <label class="form-label">Current Image</label>
                        <img id="modal_current_image" class="image-preview mb-2" style="display: block;">
                    </div>
                    <div class="mb-3">
                        <label for="modal_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="modal_image" name="image" accept="image/*" data-preview="modal_preview">
                        <img id="modal_preview" class="image-preview mt-2" style="display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="modal_status" class="form-label">Status</label>
                        <select class="form-select" id="modal_status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn" id="modal_submit_btn"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger"><i class="fas fa-trash"></i> Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this service?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
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
