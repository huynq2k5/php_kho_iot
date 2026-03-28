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

    public function layTrangThaiThietBi(){
        return $this->tbService->hienThiTatCaThietBi();
    }

    public function layJSONTrangThaiThietBi() {
        $nodes = $this->tbService->hienThiTatCaThietBi();
        header('Content-Type: application/json');
        echo json_encode($nodes);
        exit;
    }
}