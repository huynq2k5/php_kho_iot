<?php

namespace App\Controllers;

use App\Services\LogSecurityService;
use App\Services\NhatKyHeThongService;
use App\Services\ThongBaoService;

abstract class BaseController
{
    protected $logSecurityService;
    protected $nhatKyService;
    protected $thongBaoService;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->logSecurityService = new LogSecurityService();
        $this->nhatKyService = new NhatKyHeThongService();
        $this->thongBaoService = new ThongBaoService();

        $this->logSecurityService->ghiNhanTruyCap();
    }

    protected function logHeThong($hanhDong, $loaiDoiTuong, $idDoiTuong, $cu = null, $moi = null)
    {
        $idNguoiDung = $_SESSION['user_id'] ?? null;

        $data = [
            'idNguoiDung' => $idNguoiDung,
            'hanhDong' => $hanhDong,
            'loaiDoiTuong' => $loaiDoiTuong,
            'idDoiTuong' => $idDoiTuong,
            'giaTriCu'    => (is_array($cu) || is_object($cu)) ? json_encode($cu, JSON_UNESCAPED_UNICODE) : $cu,
        'giaTriMoi'   => (is_array($moi) || is_object($moi)) ? json_encode($moi, JSON_UNESCAPED_UNICODE) : $moi
        ];

        return $this->nhatKyService->ghiNhatKyMoi($data);
    }

    protected function render($view, $data = [])
    {
        extract($data);
        include_once "app/views/{$view}.php";
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function apiTimKiemChucNang() {
        $tuKhoa = $_GET['q'] ?? '';
        
        $tatCaChucNang = [
            ['ten' => 'Trang chủ', 'url' => 'index.php?page=dashboard', 'quyen' => 'dashboard.view'],
            ['ten' => 'Tự động hóa', 'url' => 'index.php?page=tudong', 'quyen' => 'tudong.view'],
            ['ten' => 'Quản lý người dùng', 'url' => 'index.php?page=users', 'quyen' => 'nguoidung.view'],
            ['ten' => 'Hồ sơ cá nhân', 'url' => 'index.php?page=profile', 'quyen' => 'all'],
            ['ten' => 'Thêm thiết bị', 'url' => 'index.php?page=thietbi_them', 'quyen' => 'thietbi.view'],
            ['ten' => 'Thêm người dùng', 'url' => 'index.php?page=nguoidung_them', 'quyen' => 'nguoidung.view'],
            ['ten' => 'Thêm nhóm', 'url' => 'index.php?page=nhom_them', 'quyen' => 'nguoidung.view']
        ];

        $ketQua = [];
        foreach ($tatCaChucNang as $item) {
            $khopTuKhoa = stripos($item['ten'], $tuKhoa) !== false;
            
            $coQuyen = ($item['quyen'] === 'all' || hasPermission($item['quyen']));

            if ($khopTuKhoa && $coQuyen) {
                $ketQua[] = [
                    'ten' => $item['ten'],
                    'url' => $item['url']
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode(array_slice($ketQua, 0, 5));
        exit;
    }
}