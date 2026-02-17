<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Hệ thống Kho IoT' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <nav id="sidebar" class="sidebar d-flex flex-column">
        <div class="sidebar-header d-flex align-items-center justify-content-center">
            <img src="public/img/kho_iot_logo.png" alt="Logo" class="sidebar-logo me-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <i class="fas fa-leaf text-warning me-2" style="display:none; font-size: 1.5rem;"></i>
            
            <span class="fw-bold logo-text">IoT WAREHOUSE</span>
        </div>
        
        <div class="flex-grow-1 mt-3">
            <?php 
                // Kiểm tra file tồn tại trước khi include để tránh lỗi Fatal Error
                if (file_exists(__DIR__ . '/../dungchung/sidebar.php')) {
                    include __DIR__ . '/../dungchung/sidebar.php';
                } else {
                    echo '<p class="text-white text-center">Lỗi: Không tìm thấy Menu</p>';
                }
            ?>
        </div>

        <div class="p-3 text-center text-secondary small border-top border-secondary sidebar-footer">
            v1.0.0 &copy; 2026
        </div>
    </nav>

    <main id="mainContent" class="main-content">
        
        <header class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm">
            <div class="d-flex align-items-center">
                <button class="btn btn-light border-0 shadow-sm me-3" id="sidebarToggle">
                    <i class="fas fa-bars text-primary"></i>
                </button>

                <h4 class="m-0 text-secondary"><?= $title ?? 'Trang chủ' ?></h4>
            </div>
            
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted d-none d-sm-inline">
                    Xin chào, <strong><?= $currentUser['name'] ?? 'Admin' ?></strong>
                </span>
                <a href="index.php?page=login" class="btn btn-outline-danger btn-sm" title="Đăng xuất">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </header>

        <div class="container-fluid p-0">
            <?php 
                if (isset($content) && file_exists($content)) {
                    include $content;
                } else {
                    echo "<div class='alert alert-danger'>Không tìm thấy nội dung: $content</div>";
                }
            ?>
        </div>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            if (sidebarToggle && sidebar && mainContent) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                });
            }
        });
    </script>
</body>
</html>