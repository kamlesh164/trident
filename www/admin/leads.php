<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$total_leads = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as cnt FROM lead_users"))['cnt'];
$total_pages = ceil($total_leads / $limit);

$leads = [];
$sql = mysqli_query($conn, "SELECT * FROM lead_users ORDER BY created_at DESC LIMIT $offset,$limit");
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        $leads[] = $row;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (mysqli_query($conn, "DELETE FROM lead_users WHERE id=$id")) {
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
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="fas fa-users"></i> Lead Users List</h1>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <i class="fas fa-clock"></i> All Lead Users
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($leads) > 0):
                            $index = $offset + 1;
                            foreach ($leads as $row): ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></td>
                            <td><?php 
                                $msg = strip_tags($row['message']);
                                echo htmlspecialchars(strlen($msg) > 40 ? substr($msg, 0, 40).'...' : $msg); 
                            ?></td>
                            <td><?php echo date('M d, Y h:i A', strtotime($row['created_at'])); ?></td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-info view-btn"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewLeadModal"
                                    data-name="<?php echo htmlspecialchars($row['name']); ?>"
                                    data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                    data-subject="<?php echo htmlspecialchars($row['subject']); ?>"
                                    data-message="<?php echo htmlspecialchars($row['message']); ?>"
                                    data-ip="<?php echo htmlspecialchars($row['ip']); ?>"
                                    data-date="<?php echo date('M d, Y h:i A', strtotime($row['created_at'])); ?>"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php 
                            $index++;
                            endforeach;
                        else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No leads found.</td>
                        </tr>
                        <?php endif; ?>
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

    <!-- View Modal -->
    <div class="modal fade" id="viewLeadModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-eye"></i> Lead Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2"><strong>Name:</strong> <span id="modal_lead_name"></span></div>
            <div class="mb-2"><strong>Email:</strong> <span id="modal_lead_email"></span></div>
            <div class="mb-2"><strong>Subject:</strong> <span id="modal_lead_subject"></span></div>
            <div class="mb-2"><strong>Date:</strong> <span id="modal_lead_date"></span></div>
            <hr/>
            <div><strong>Message:</strong></div>
            <div style="background:#f8f9fa;padding:12px;border-radius:8px;min-height:48px;white-space:pre-line;" id="modal_lead_message"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
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

<!-- NO MODAL, NO ADD/EDIT/DELETE BUTTONS -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>
</body>
</html>
