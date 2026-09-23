<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$success = $error = '';
// Select About Heading
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

// AJAX: Add new Vision/Mission Point (returns <li> HTML)
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ajax']) && $_POST['ajax']=='1' && isset($_POST['action']) && $_POST['action']=='add_list') {
    $section = $_POST['section'];
    $list_text = mysqli_real_escape_string($conn,$_POST['list_text']);
    $order_no = 0;
    mysqli_query($conn,"INSERT INTO about_page (section,item_type,list_text,order_no) VALUES('$section','list','$list_text',$order_no)");
    $id = mysqli_insert_id($conn);
    echo '<li class="list-group-item d-flex justify-content-between align-items-center" id="li_'.$id.'">'
        .htmlspecialchars($list_text)
        .'<span>
            <button type="button" class="btn btn-sm btn-warning" onclick="editListItem(\''.$section.'\','.$id.',\''.htmlspecialchars(addslashes($list_text)).'\')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-danger ms-1" onclick="deleteListItem('.$id.',\''.$section.'\')"><i class="fas fa-trash"></i></button>
        </span></li>';
    exit;
}

// AJAX: Delete Vision/Mission Point
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ajax']) && $_POST['ajax']=='1' && isset($_POST['action']) && $_POST['action']=='delete_list' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    mysqli_query($conn,"DELETE FROM about_page WHERE id=$id");
    echo 'OK'; exit;
}

// Success/Error alerts, normal POST actions (edit, about head, update title, edit point)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!isset($_POST['ajax']) || $_POST['ajax'] != '1')) {
    if (isset($_POST['action']) && $_POST['action']=='about_head') {
        $title = mysqli_real_escape_string($conn, $_POST['about_title']);
        $desc = mysqli_real_escape_string($conn, $_POST['about_desc']);
        $image_path = $about ? $about['image'] : '';
        if (isset($_FILES['about_image']) && $_FILES['about_image']['error'] == 0) {
            $upload_dir = "uploads/about_head/";
            if (!file_exists($upload_dir)) mkdir($upload_dir,0777,true);
            $ext = pathinfo($_FILES['about_image']['name'],PATHINFO_EXTENSION);
            $new_filename = time().'_'.uniqid().'.'.$ext;
            $upload_path = $upload_dir.$new_filename;
            if (move_uploaded_file($_FILES['about_image']['tmp_name'],$upload_path)) {
                $image_path = $upload_path;
                if ($about && $about['image'] && file_exists($about['image'])) unlink($about['image']);
            }
        }
        if ($about) {
            mysqli_query($conn,"UPDATE about_page SET image='$image_path', title='$title', description='$desc' WHERE id=".$about['id']);
        } else {
            mysqli_query($conn,"INSERT INTO about_page (section,item_type,image,title,description) VALUES ('about','main','$image_path','$title','$desc')");
        }
        $_SESSION['success'] = 'About Us updated!';
        header("Location: ".$_SERVER['PHP_SELF']); exit;
    }
    // Vision/Mission Title update
    if (isset($_POST['action']) && $_POST['action']=='update_title') {
        $section = $_POST['section'];
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $found = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM about_page WHERE section='$section' AND item_type='main' LIMIT 1"));
        if ($found) {
            mysqli_query($conn,"UPDATE about_page SET title='$title' WHERE id=".$found['id']);
        } else {
            mysqli_query($conn,"INSERT INTO about_page (section,item_type,title) VALUES('$section','main','$title')");
        }
        $_SESSION['success'] = ucfirst($section).' Title Updated!';
        header("Location: ".$_SERVER['PHP_SELF']); exit;
    }
    if (isset($_POST['action']) && $_POST['action']=='edit_list') {
        $id = intval($_POST['id']);
        $list_text = mysqli_real_escape_string($conn,$_POST['list_text']);
        mysqli_query($conn,"UPDATE about_page SET list_text='$list_text' WHERE id=$id");
        $_SESSION['success'] = 'Updated!';
        header("Location: ".$_SERVER['PHP_SELF']); exit;
    }
    if (isset($_POST['action']) && $_POST['action']=='delete_list') {
        $id = intval($_POST['id']);
        mysqli_query($conn,"DELETE FROM about_page WHERE id=$id");
        $_SESSION['success'] = 'Deleted!';
        header("Location: ".$_SERVER['PHP_SELF']); exit;
    }
}

if (!empty($_SESSION['success'])) { $success=$_SESSION['success']; unset($_SESSION['success']); }
if (!empty($_SESSION['error']))   { $error=$_SESSION['error']; unset($_SESSION['error']); }
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items['aboutus']['icon'] ?>"></i> <?php echo $menu_items['aboutus']['title']; ?></h1>
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
    
    <!-- About Heading Edit -->
    <div class="card mb-4">
      <div class="card-header"><i class="fas fa-edit"></i> Edit Heading & Description</div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="action" value="about_head">
          <div class="mb-3">
            <label for="about_image" class="form-label">Heading Image</label>
            <input type="file" class="form-control" id="about_image" name="about_image" accept="image/*">
            <?php if($about && $about['image']): ?>
                <img src="<?= $about['image'] ?>" style="max-width:320px;margin-top:10px;">
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Heading Title</label>
            <input type="text" class="form-control" name="about_title" value="<?= htmlspecialchars( !empty($about['title'])?$about['title']:''); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="about_desc" rows="5" required><?= htmlspecialchars(!empty($about['description'])?$about['description']:'') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
        </form>
      </div>
    </div>

    <!-- Vision Section -->
    <div class="card mb-4">
      <div class="card-header"><b>Our Vision</b></div>
      <div class="card-body">
        <form method="POST" class="mb-2">
          <input type="hidden" name="action" value="update_title">
          <input type="hidden" name="section" value="vision">
          <div class="row mb-2">
            <div class="col-md-10">
                <textarea class="form-control" name="title" rows="5" placeholder="Vision Title" required><?= htmlspecialchars($vision_title) ?></textarea>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary w-100">Update Title</button>
            </div>
          </div>
        </form>
        <form method="POST" class="mb-2 vision-add-form">
          <input type="hidden" name="section" value="vision">
          <div class="row">
            <div class="col-md-10"><input type="text" name="list_text" class="form-control" placeholder="Add Vision point..." required></div>
            <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Add point</button></div>
          </div>
        </form>
        <ul class="list-group" id="vision-list">
          <?php foreach($vision_lists as $v): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center" id="li_<?= $v['id'] ?>">
              <?= htmlspecialchars($v['list_text']) ?>
              <span>
                <!-- Edit Modal Trigger -->
                <button type="button" class="btn btn-sm btn-warning" onclick="editListItem('vision',<?= $v['id'] ?>,'<?= htmlspecialchars(addslashes($v['list_text'])) ?>')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger ms-1" onclick="deleteListItem(<?= $v['id'] ?>,'vision')"><i class="fas fa-trash"></i></button>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <!-- Mission Section -->
    <div class="card mb-4">
      <div class="card-header"><b>Our Mission</b></div>
      <div class="card-body">
        <form method="POST" class="mb-2">
          <input type="hidden" name="action" value="update_title">
          <input type="hidden" name="section" value="mission">
          <div class="row mb-2">
            <div class="col-md-10">
                <textarea class="form-control" name="title" rows="5" placeholder="Mission Title" required><?= htmlspecialchars($mission_title) ?></textarea>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary w-100">Update Title</button>
            </div>
          </div>
        </form>
        <form method="POST" class="mb-2 mission-add-form">
          <input type="hidden" name="section" value="mission">
          <div class="row">
            <div class="col-md-10"><input type="text" name="list_text" class="form-control" placeholder="Add Mission point..." required></div>
            <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Add point</button></div>
          </div>
        </form>
        <ul class="list-group" id="mission-list">
          <?php foreach($mission_lists as $m): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center" id="li_<?= $m['id'] ?>">
              <?= htmlspecialchars($m['list_text']) ?>
              <span>
                <button type="button" class="btn btn-sm btn-warning" onclick="editListItem('mission',<?= $m['id'] ?>,'<?= htmlspecialchars(addslashes($m['list_text'])) ?>')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger ms-1" onclick="deleteListItem(<?= $m['id'] ?>,'mission')"><i class="fas fa-trash"></i></button>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
</div>

<!-- List Edit Modal -->
<div class="modal fade" id="editListModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST">
      <div class="modal-header">
        <h5 class="modal-title">Edit Point</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="action" value="edit_list">
        <input type="hidden" name="id" id="edit_list_id">
        <input type="text" name="list_text" id="edit_list_text" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
<!-- Scripts -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>

<script>
$('.vision-add-form').on('submit', function(e){
    e.preventDefault();
    var $form = $(this), list = $('#vision-list');
    var section = 'vision';
    var list_text = $form.find('input[name="list_text"]').val();
    $.post(window.location.href, {ajax:'1', action:'add_list', section:section, list_text:list_text}, function(li){
        list.append(li);
        $form[0].reset();
    });
});
$('.mission-add-form').on('submit', function(e){
    e.preventDefault();
    var $form = $(this), list = $('#mission-list');
    var section = 'mission';
    var list_text = $form.find('input[name="list_text"]').val();
    $.post(window.location.href, {ajax:'1', action:'add_list', section:section, list_text:list_text}, function(li){
        list.append(li);
        $form[0].reset();
    });
});
function deleteListItem(id, section){
    if(!confirm('Delete this point?')) return;
    $.post(window.location.href, {ajax:'1', action:'delete_list', id:id}, function(res){
        if(res==='OK') $('#li_'+id).fadeOut(function(){$(this).remove();});
    });
}
function editListItem(section,id,text){
    $('#edit_list_id').val(id);
    $('#edit_list_text').val(text);
    $('#editListModal').modal('show');
}
</script>
</body>
</html>
