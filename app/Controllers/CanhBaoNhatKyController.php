<?php

namespace App\Controllers;

use App\Services\NhatKyHeThongService;
use App\Services\ThongBaoService;

class CanhBaoNhatKyController {
    private $nhatKyService;
    private $thongBaoService;

    public function __construct()
    {
        $this->nhatKyService = new NhatKyHeThongService();
        $this->thongBaoService = new ThongBaoService();
    }

    public function layDuLieuManHinhChinh() {
        return [
            'canhBao' => $this->thongBaoService->layCanhBaoMoiNhat(10),
            'nhatKy'  => $this->nhatKyService->hienThiTatCaNhatKy(20)
        ];
    }

    public function webXoaLichSuCu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $soNgay = $_POST['soNgay'] ?? 30;
            $kq = $this->nhatKyService->donDepNhatKy($soNgay);

            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=alert_log');
            exit;
        }
    }

    public function webXuatBaoCao() {
        // Chưa viết logic xuất báo cáo
        header('Location: index.php?page=alert_log');
        exit;
    }

    public function webTimKiemNhatKy()
    {
        $tuKhoa = $_GET['tuKhoa'] ?? '';
        return $this->nhatKyService->timKiemNhatKy($tuKhoa);
    }
}