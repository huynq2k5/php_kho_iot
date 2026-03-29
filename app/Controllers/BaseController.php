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
}