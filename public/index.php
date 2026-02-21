<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$page = $_GET['page'] ?? 'dashboard';

// 1. DANH SÁCH TRANG CÔNG KHAI
$publicPages = ['auth', 'auth_xuly_dangnhap', '404', '403'];

if (!isset($_SESSION['user_id']) && !in_array($page, $publicPages)) {
    header('Location: index.php?page=auth');
    exit;
}

// 2. CHUẨN HÓA ĐƯỜNG DẪN
$viewDir = realpath(__DIR__ . '/../views');
$layout = isset($_SESSION['user_id']) ? 'main' : 'auth';
$title = "Hệ thống quản lý Kho IoT";

function hasPermission($permissionCode) {
    if (!isset($_SESSION['permissions']) || !is_array($_SESSION['permissions'])) {
        return false;
    }
    return in_array($permissionCode, $_SESSION['permissions']);
}

// 3. ĐIỀU HƯỚNG VÀ KIỂM TRA QUYỀN
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
        if (hasPermission('trangchu.view')) {
            $title = "Tổng quan kho";
            $viewFile = $viewDir . '/trangchu/index.php';
        } else {
            $page = '403';
        }
        break;

    // Các tab thiết bị
    case 'thietbi':
    case 'thietbi_config':
    case 'thietbi_them':
        if (hasPermission('thietbi.view')) {
            $viewFile = $viewDir . "/thietbi/" . (strpos($page, '_') !== false ? explode('_', $page)[1] : 'index') . ".php";
        } else {
            $page = '403';
        }
        break;

    // Phân tích và Tự động hóa
    case 'phantich':
        if (hasPermission('phantich.view')) {
            $viewFile = $viewDir . '/phantich/index.php';
        } else {
            $page = '403';
        }
        break;

    case 'tudong':
        if (hasPermission('tudong.view')) {
            $viewFile = $viewDir . '/tudong/index.php';
        } else {
            $page = '403';
        }
        break;

    case 'alert_log':
        if (hasPermission('canhbao.view')) {
            $viewFile = $viewDir . '/alert_log/index.php';
        } else {
            $page = '403';
        }
        break;

    // Quản lý người dùng
    case 'users':
        if (hasPermission('nguoidung.view')) {
            $title = "Quản lý nhân viên";
            
            $userController = new \App\Controllers\NguoiDungController();
            
            $danhSachNguoiDung = $userController->layDuLieuNguoiDung();
            $danhSachNhom = $userController->layDuLieuNhom();
            $danhSachQuyen = $userController->layDuLieuQuyen();
            
            $viewFile = $viewDir . '/users/index.php';
        } else {
            $page = '403';
        }
        break;
    case 'nguoidung_them':
        if (hasPermission('nguoidung.view')) {
            $viewFile = $viewDir . '/users/them_user.php';
        } else {
            $page = '403';
        }
        break;
    case 'nguoidung_sua':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $userController = new \App\Controllers\NguoiDungController();
            $data = $userController->layThongTinSua($id);
            
            $user = $data['user'];
            $danhSachNhom = $data['danhSachNhom'];

            if ($user) {
                $viewFile = $viewDir . '/users/sua_user.php';
            } else {
                $page = '404';
            }
        }
        break;
    case 'nhom_them':
        if (hasPermission('nguoidung.view')) {
            $viewFile = $viewDir . '/users/them_nhom.php';
        } else {
            $page = '403';
        }
        break;
    case 'nhom_sua':
        if (hasPermission('nguoidung.view')) {
            $viewFile = $viewDir . '/users/sua_nhom.php';
        } else {
            $page = '403';
        }
        break;
    case 'quyen_them':
        if (hasPermission('nguoidung.view')) {
            $viewFile = $viewDir . '/users/them_quyen.php';
        } else {
            $page = '403';
        }
        break;
    case 'quyen_sua':
        if (hasPermission('nguoidung.view')) {
            $viewFile = $viewDir . '/users/sua_quyen.php';
        } else {
            $page = '403';
        }
        break;

    case '404':
        $viewFile = $viewDir . '/error/404.php';
        break;

    default:
        $viewFile = $viewDir . '/error/404.php';
        break;
}

// XỬ LÝ LỖI 403 (Nếu bị gán lại từ các case trên)
if ($page === '403') {
    $title = "403 - Truy cập bị từ chối";
    $viewFile = $viewDir . '/error/403.php';
}

// 4. KIỂM TRA FILE VÀ NẠP NỘI DUNG
if ($viewFile && file_exists($viewFile)) {
    ob_start();
    include $viewFile;
    $content = ob_get_clean();
} else {
    $content = "<h2 class='text-red-500'>Lỗi: Nội dung không tồn tại tại $viewFile</h2>";
}

// 5. HIỂN THỊ LAYOUT
$layoutPath = $viewDir . "/layouts/{$layout}.php";
if (file_exists($layoutPath)) {
    include $layoutPath;
} else {
    echo "Lỗi hệ thống: Layout không tồn tại.";
}