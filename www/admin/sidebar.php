<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4><i class="fas fa-home"></i> Menu</h4>
    </div>

    <ul class="sidebar-menu">
        <?php foreach ($menu_items as $page => $item): ?>
            <li class="<?php echo ($current_page == $item['page']) ? 'active' : ''; ?>">
                <a href="<?php echo $item['url']; ?>">
                    <i class="<?php echo $item['icon']; ?>"></i>
                    <span><?php echo $item['title']; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
