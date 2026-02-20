<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$page = $_GET['page'] ?? 'dashboard';

// 1. KIỂM TRA ĐĂNG NHẬP
if (!isset($_SESSION['user_id']) && !in_array($page, ['auth', 'auth_xuly_dangnhap'])) {
    header('Location: index.php?page=auth');
    exit;
}

// 2. CHUẨN HÓA ĐƯỜNG DẪN (Dùng realpath để mất dấu /../)
$viewDir = realpath(__DIR__ . '/../views');
$layout = 'main';
$title = "Hệ thống quản lý Kho IoT";

// 3. ĐIỀU HƯỚNG CHI TIẾT
switch ($page) {
    case 'auth':
        $layout = 'auth';
        $viewFile = $viewDir . '/auth/login.php';
        break;

    case 'auth_xuly_dangnhap':
        $controller = new \App\Controllers\AuthController();
        $controller->webLogin();
        exit;

    case 'logout':
        $controller = new \App\Controllers\AuthController();
        $controller->logout();
        exit;

    case 'dashboard':
        $title = "Tổng quan kho";
        $viewFile = $viewDir . '/trangchu/index.php';
        break;

    // Các tab thiết bị
    case 'thietbi':
        $viewFile = $viewDir . '/thietbi/index.php';
        break;
    case 'thietbi_config':
        $viewFile = $viewDir . '/thietbi/config.php';
        break;
    case 'thietbi_them':
        $viewFile = $viewDir . '/thietbi/them.php';
        break;

    // Các tab tự động hóa và phân tích
    case 'phantich':
        $viewFile = $viewDir . '/phantich/index.php';
        break;
    case 'tudong':
        $viewFile = $viewDir . '/tudong/index.php';
        break;
    case 'alert_log':
        $viewFile = $viewDir . '/alert_log/index.php';
        break;

    // Quản lý người dùng và nhóm quyền
    case 'users':
        $title = "Quản lý nhân viên";
        $viewFile = $viewDir . '/users/index.php';
        break;
    case 'sua_nhom':
        $isEdit = true;
        $viewFile = $viewDir . '/users/sua_nhom.php';
        break;
    case 'users_them_quyen':
        $viewFile = $viewDir . '/users/them_quyen.php';
        break;

    default:
        $viewFile = $viewDir . '/error/404.php';
        break;
}

// 4. KIỂM TRA FILE VÀ NẠP NỘI DUNG
if ($viewFile && file_exists($viewFile)) {
    ob_start();
    include $viewFile;
    $content = ob_get_clean();
} else {
    $content = "<h2 class='text-red-500'>Lỗi: Không tìm thấy file tại $viewFile</h2>";
}

// 5. HIỂN THỊ LAYOUT
$layoutPath = $viewDir . "/layouts/{$layout}.php";
if (file_exists($layoutPath)) {
    include $layoutPath;
} else {
    echo "Lỗi hệ thống: Layout không tồn tại.";
}