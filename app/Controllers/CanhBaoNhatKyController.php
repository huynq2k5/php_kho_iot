<?php

namespace App\Controllers;

use App\Services\NhatKyHeThongService;
use App\Services\ThongBaoService;
use App\Services\LogSecurityService;

class CanhBaoNhatKyController extends BaseController {
    private $nhatKyService;
    private $thongBaoService;
    private $securityService;

    public function __construct() {
        parent::__construct();
        $this->nhatKyService = new NhatKyHeThongService();
        $this->thongBaoService = new ThongBaoService();
        $this->securityService = new LogSecurityService();
    }

    public function layDuLieuManHinhChinh() {
        return [
            'canhBao' => $this->thongBaoService->layCanhBaoMoiNhat(10),
            'nhatKy'  => $this->nhatKyService->hienThiTatCaNhatKy(20),
            'truyCap' => $this->securityService->layDanhSachTruyCap(10)
        ];
    }

    public function webHienThiChiTietTruyCap() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?page=alert_log');
            exit;
        }

        $access = $this->securityService->layChiTietTruyCap($id);
        
        if (!$access) {
            header('Location: index.php?page=alert_log');
            exit;
        }

        return $access;
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

    public function webTimKiemNhatKy() {
        $tuKhoa = $_GET['tuKhoa'] ?? '';
        return $this->nhatKyService->timKiemNhatKy($tuKhoa);
    }

    public function webXuatBaoCao() {
        header('Location: index.php?page=alert_log');
        exit;
    }
}