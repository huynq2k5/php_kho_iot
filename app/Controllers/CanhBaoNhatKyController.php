<?php

namespace App\Controllers;

class CanhBaoNhatKyController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function layDuLieuManHinhChinh() {
        return [
            'canhBao' => $this->thongBaoService->layCanhBaoMoiNhat(10),
            'nhatKy'  => $this->nhatKyService->hienThiTatCaNhatKy(20),
            'truyCap' => $this->logSecurityService->layDanhSachTruyCap(10)
        ];
    }

    public function webHienThiChiTietTruyCap() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?page=alert_log');
            exit;
        }

        $access = $this->logSecurityService->layChiTietTruyCap($id);
        
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

            $this->logHeThong("Dọn dẹp nhật ký hệ thống cũ hơn {$soNgay} ngày", "CAU_HINH", 0);

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