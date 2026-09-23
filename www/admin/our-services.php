<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';
$category = 'our-services';

// Pagination setup
$limit = 4;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Handle add/edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "uploads/$category/";
        if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); }
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $new_filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) { $image_path = $upload_path; }
    }

    if ($_POST['action'] == 'add') {
        if ($image_path) {
            $query = "INSERT INTO services (title, image, category) VALUES ('$title', '$image_path', '$category')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = 'Service added!';
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
            $query = "UPDATE services SET title='$title', image='$image_path' WHERE id=$id AND category = '$category'";
        } else {
            $query = "UPDATE services SET title='$title' WHERE id=$id AND category = '$category'";
        }
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Service updated!';
            header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
            exit;
        } else {
            $_SESSION['error'] = 'Error updating service.';
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
        $_SESSION['success'] = 'Service deleted!';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    } else {
        $_SESSION['error'] = 'Error deleting service.';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    }
}

if (!empty($_SESSION['success'])) { $success = $_SESSION['success']; unset($_SESSION['success']); }
if (!empty($_SESSION['error'])) { $error = $_SESSION['error']; unset($_SESSION['error']); }

$total_services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as cnt FROM services WHERE category = '$category'"))['cnt'];
$total_pages = ceil($total_services / $limit);

$services = [];
$sql = mysqli_query($conn, "SELECT * FROM services WHERE category = '$category' ORDER BY created_at DESC LIMIT $offset,$limit");
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
        <h1><i class="<?php echo $menu_items[$category]['icon'] ?>"></i> <?php echo $menu_items[$category]['title']; ?></h1>
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
        <button class="btn btn-primary service-add-btn" data-bs-toggle="modal" data-bs-target="#serviceModal">
            <i class="fas fa-plus"></i> Add New Service
        </button>
    </div>

    <div class="card">
        <div class="card-header"><i class="fas fa-list"></i> All Services</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (count($services) > 0) {
                        $index = $offset + 1;
                        foreach ($services as $row) { ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><img src="<?php echo $row['image']; ?>" alt="Image" style="width:80px;height:60px;object-fit:cover;"></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning service-edit-btn"
                                    data-id="<?php echo $row['id']; ?>"
                                    data-title="<?php echo htmlspecialchars($row['title']); ?>"
                                    data-image="<?php echo $row['image']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                            </td>
                        </tr>
                    <?php $index++; } } else { ?>
                        <tr><td colspan="4" class="text-center">No services found! Add your first.</td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <?php if($total_pages > 1): ?>
            <nav>
              <ul class="pagination justify-content-center">
                <?php for($p=1;$p<=$total_pages;$p++): ?>
                <li class="page-item <?php echo $p==$page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
                <?php endfor; ?>
              </ul>
            </nav>
            <?php endif; ?>
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
              <div class="mb-3" id="current_img_box" style="display:none;">
                  <label class="form-label">Current Image</label>
                  <img id="modal_current_image" class="image-preview mb-2" style="display:block;">
              </div>
              <div class="mb-3">
                  <label for="modal_image" class="form-label">Image</label>
                  <input type="file" class="form-control" id="modal_image" name="image" accept="image/*" data-preview="modal_preview">
                  <img id="modal_preview" class="image-preview mt-2" style="display:none;">
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
