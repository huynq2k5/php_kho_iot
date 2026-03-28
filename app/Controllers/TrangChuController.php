<?php
namespace App\Controllers;

use App\Services\KichBanTuDongService;
use App\Services\ThietBiService;

class TrangChuController {
    private $kbService;
    private $tbService;

    public function __construct() {
        $this->kbService = new KichBanTuDongService();
        $this->tbService = new ThietBiService();
    }

    public function toggleMasterMode() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $mode = $_GET['mode'] ?? 'auto';
        $isManual = ($mode === 'manual');
        
        $result = $this->kbService->voHieuHoaToanBoHeThong($isManual);

        if ($result) {
            $_SESSION['msg'] = 'edit_success';
        } else {
            $_SESSION['msg'] = 'edit_error';
        }

        header('Location: index.php?page=dashboard');
        exit;
    }

    public function layTrangThaiThietBi(){
        return $this->tbService->hienThiTatCaThietBi();
    }
}