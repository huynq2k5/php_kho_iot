<?php
// public/index.php

// 1. Giả lập dữ liệu dùng chung (Thay cho Controller)
$currentUser = ['role' => 'ADMIN', 'name' => 'Nguyen Van A']; // Thử sửa thành MEMBER để test

// 2. Lấy trang cần xem từ URL (Ví dụ: index.php?page=thietbi)
// Nếu không có ?page thì mặc định vào 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// 3. Định nghĩa đường dẫn đến thư mục views (Lùi lại 1 cấp ra khỏi public)
$viewDir = __DIR__ . '/../views';

// 4. Switch-Case điều hướng (Router tạm thời)
switch ($page) {
    case 'dashboard':
        $title = "Tổng quan";
        $content = $viewDir . '/trangchu/index.php'; // Đường dẫn file view
        break;

    case 'thietbi':
        $title = "";
        $content = $viewDir . '/thietbi/index.php';
        break;

    case 'phantich':
        $title = "";
        $content = $viewDir . '/phantich/index.php';
        break;
    case 'tudong':
        $title = "Tự động hoá";
        $content = $viewDir . '/tudong/index.php';
        break;
    case 'tudong-sua':
        $title = "Tự động hoá";
        $content = $viewDir . '/tudong/sua.php';
        break;
    case 'tudong-them':
        $title = "Tự động hoá";
        $content = $viewDir . '/tudong/them.php';
        break;
    case 'alert_log':
        $title = "";
        $content = $viewDir . '/alert_log/index.php';
        break;
    case 'thietbi_config':
        $title = "";
        $content = $viewDir . '/thietbi/config.php';
        break;
    case 'thietbi_them':
        $title = "";
        $content = $viewDir . '/thietbi/them.php';
        break;
    case 'users':
        $title = "Quản lý người dùng";
        $content = $viewDir . '/users/index.php';
        break;
    case 'users_them_nhom':
        $title = "Quản lý người dùng";
        $content = $viewDir . '/users/them_nhom.php';
        break;
    case 'users_them_quyen':
        $title = "Quản lý người dùng";
        $content = $viewDir . '/users/them_quyen.php';
        break;
    case 'nguoidung_them':
        $title = "Quản lý người dùng";
        $content = $viewDir . '/users/form.php';
        break;
        
    case 'auth':
        // Trang login không dùng layout chung nên include trực tiếp và exit
        include $viewDir . '/auth/login.php';
        exit;

    default:
        $title = "Lỗi";
        $content = $viewDir . '/error/404.php';
        break;
}

// 5. Gọi Layout chính để hiển thị (Layout sẽ bọc lấy $content)
// Lưu ý: Bạn cần tạo file views/layouts/main.php trước
if (file_exists($viewDir . '/layouts/main.php')) {
    include $viewDir . '/layouts/main.php';
} else {
    echo "Chưa có file layout! Hãy tạo views/layouts/main.php";
}
?>