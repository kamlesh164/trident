<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';
$type = 'portfolio';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $files = $_FILES['images'];
    $total = count($files['name']);
    for ($i = 0; $i < $total; $i++) {
        if ($files['error'][$i] === 0) {
            $upload_dir = "uploads/$type/";
            if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
            $file_extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
            $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_filename;
            if (move_uploaded_file($files['tmp_name'][$i], $upload_path)) {
                $maxOrderResult = mysqli_query($conn, "SELECT MAX(display_order) as max_order FROM gallery_items WHERE type='$type'");
                $maxOrder = mysqli_fetch_assoc($maxOrderResult)['max_order'] ?? 0;
                $nextOrder = $maxOrder + 1;
                $query = "INSERT INTO gallery_items (image_path, display_order, type) VALUES ('$upload_path', $nextOrder, '$type')";
                mysqli_query($conn, $query);
            }
        }
    }
    $_SESSION['success'] = 'Images added successfully!';
    header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
    exit;
}

// ---- Delete Image ----
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image_path FROM gallery_items WHERE id=$id AND type='$type'"))['image_path'];
    if (mysqli_query($conn, "DELETE FROM gallery_items WHERE id=$id AND type='$type'")) {
        if (file_exists($img)) unlink($img);
        $success = 'Image deleted successfully!';
        // Reorder remaining images
        $images = mysqli_query($conn, "SELECT id FROM gallery_items WHERE type = '$type' ORDER BY display_order");
        $order = 1;
        while ($row = mysqli_fetch_assoc($images)) {
            mysqli_query($conn, "UPDATE gallery_items SET display_order=$order WHERE id=" . $row['id'] ." AND type='$type'");
            $order++;
        }
        $_SESSION['success'] = $success;
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    } else {
        $_SESSION['error'] = 'Error deleting image.';
        header("Location: ".str_replace('.php', '', $_SERVER['PHP_SELF']));
        exit;
    }
}

// ---- AJAX Order Save ----
if (isset($_POST['order'])) {
    foreach ($_POST['order'] as $img) {
        $id = intval($img['id']);
        $order = intval($img['order']);
        mysqli_query($conn, "UPDATE gallery_items SET display_order = $order WHERE id = $id" ." AND type='$type'");
    }
    echo json_encode(['status'=>'success']);
    exit;
}

$images = mysqli_query($conn, "SELECT * FROM gallery_items WHERE type = '$type' ORDER BY display_order");

if (!empty($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items['portfolio']['icon'] ?>"></i> <?php echo $menu_items['portfolio']['title']; ?></h1>
    </div>

    <!-- Success/Error Alert Section -->
    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <span id="phpSuccessMsg"><?php echo $success; ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Add Images Button -->
    <div class="mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus"></i> Add Images
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="row" id="galleryGrid">
        <?php if (mysqli_num_rows($images) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($images)): ?>
            <div class="col-md-3 mb-3 gallery-item" data-id="<?= $row['id'] ?>">
                <div class="card">
                    <img src="<?= $row['image_path'] ?>" class="card-img-top" style="height:150px;object-fit:cover;" alt="Gallery Image">
                    <div class="card-body text-center">
                        <h6 class="card-title">Image #<?= $row['display_order'] ?></h6>
                        <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No images uploaded yet. Add your first image!</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if (mysqli_num_rows($images) > 0): ?>
        <button id="saveOrderBtn" class="btn btn-success mt-3">Save Order</button>
    <?php endif; ?>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Add Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="images" class="form-label">Select Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
                        <small class="text-muted">Recommended size: 1200x800px</small>
                        <div id="multi_preview" class="mt-3"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger"><i class="fas fa-trash"></i> Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this image?</p>
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
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>
<script>
$(function(){
    $("#images").on('change', function(){
        $("#multi_preview").html('');
        Array.from(this.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(e){
                $("#multi_preview").append('<img src="'+e.target.result+'" style="max-width:100px;max-height:100px;margin:7px;border-radius:7px;box-shadow:0 0 7px #ddd;">');
            };
            reader.readAsDataURL(file);
        });
    });

    $("#galleryGrid").sortable();
    $("#saveOrderBtn").click(function(){
        var orderArr = [];
        $("#galleryGrid .gallery-item").each(function(idx){
            orderArr.push({ id: $(this).data('id'), order: idx + 1 });
        });
        $.post('portfolio', { order: orderArr }, function(resp){
            try {
                var r = JSON.parse(resp);
                if (r.status === "success") {
                    sessionStorage.setItem('gallery_order_success', 'Order updated!');
                    location.reload();
                }
            } catch(e) {
                sessionStorage.setItem('gallery_order_success', 'Something went wrong!');
                location.reload();
            }
        });
    });

    if (sessionStorage.getItem('gallery_order_success')) {
        var msg = sessionStorage.getItem('gallery_order_success');
        $('.page-header').after(
            '<div class="alert alert-success alert-dismissible fade show">' +
            '<i class="fas fa-check-circle"></i> ' + msg +
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
            '</div>'
        );
        sessionStorage.removeItem('gallery_order_success');
    }
});
</script>
</body>
</html>
