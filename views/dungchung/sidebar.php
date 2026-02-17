<?php
    // Lấy trang hiện tại, mặc định là 'dashboard' nếu không có tham số
    $p = $_GET['page'] ?? 'dashboard';
?>

<ul class="nav flex-column">
    <li class="nav-item">
        <a href="index.php?page=dashboard" class="nav-link d-flex align-items-center <?= $p == 'dashboard' ? 'active' : '' ?>">
            <i class="fas fa-home me-2"></i> 
            <span class="menu-text">Tổng quan</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="index.php?page=phantich" class="nav-link d-flex align-items-center <?= $p == 'phantich' ? 'active' : '' ?>">
            <i class="fas fa-chart-line me-2"></i> 
            <span class="menu-text">Phân tích</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="index.php?page=tudong" class="nav-link d-flex align-items-center <?= $p == 'tudong' ? 'active' : '' ?>">
            <i class="fas fa-microchip me-2"></i> 
            <span class="menu-text">Tự động hoá</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="index.php?page=alert_log" class="nav-link d-flex align-items-center <?= $p == 'alert_log' ? 'active' : '' ?>">
            <i class="fas fa-history me-2"></i> 
            <span class="menu-text">Cảnh báo và Nhật ký</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="index.php?page=thietbi" class="nav-link d-flex align-items-center <?= $p == 'thietbi' ? 'active' : '' ?>">
            <i class="fas fa-server me-2"></i> 
            <span class="menu-text">Thiết bị</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="index.php?page=users" class="nav-link d-flex align-items-center <?= $p == 'users' ? 'active' : '' ?>">
            <i class="fas fa-users-cog me-2"></i> 
            <span class="menu-text">Người dùng</span>
        </a>
    </li>
</ul>