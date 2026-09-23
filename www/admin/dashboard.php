<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
checkLogin();

$leads_count = mysqli_fetch_assoc(result: mysqli_query($conn, "SELECT COUNT(*) as count FROM lead_users"))['count'];
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1><i class="<?php echo $menu_items['dashboard']['icon'] ?>"></i> <?php echo $menu_items['dashboard']['title']; ?></h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="residential" style="text-decoration:none;">
                <div class="card stat-card commercial_card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-dark">Residential Services</p>
                        </div>
                        <i class="fas fa-home"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="commercial" style="text-decoration:none;">
                <div class="card stat-card commercial_card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-dark">Commercial Services</p>
                        </div>
                        <i class="fas fa-building"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card total_services_card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h3 class="mb-0" style="font-size:2rem;"><?php echo $leads_count; ?></h3>
                        <span class="ms-2" style="font-size:1rem; font-weight:500;">Total Leads</span>
                    </div>
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-clock"></i> Recent Leads
                </div>
                <div class="card-body">
                    <?php
                    // Latest 5 leads by most recent
                    $recent_leads = mysqli_query($conn, "SELECT * FROM lead_users ORDER BY created_at DESC LIMIT 5");
                    if (mysqli_num_rows($recent_leads) > 0):
                    ?>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($recent_leads)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td>
                                        <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>">
                                            <?php echo htmlspecialchars($row['email']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo 'Recieved on '. date('M d, Y', strtotime($row['created_at'])); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p class="text-muted">No leads yet.</p>
                    <?php endif; ?>
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
