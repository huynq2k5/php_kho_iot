<?php
namespace App\Controllers;

use App\Services\KichBanTuDongService;
use App\Services\ThietBiService;
use App\Services\LichSuCamBienService;

class TrangChuController {
    private $kbService;
    private $tbService;
    private $lsService;

    public function __construct() {
        $this->kbService = new KichBanTuDongService();
        $this->tbService = new ThietBiService();
        $this->lsService = new LichSuCamBienService();
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

    public function index() {
        $ov = $this->lsService->layThongSoTrungBinhHeThong();
        
        // Tạo mảng trạng thái dựa trên hàm phân tích
        $status = [
            'temp'  => $this->lsService->phanTichTrangThai('temp', $ov['avgTemp']),
            'hum'   => $this->lsService->phanTichTrangThai('hum', $ov['avgHum']),
            'co2'   => $this->lsService->phanTichTrangThai('co2', $ov['avgCo2']),
            'light' => $this->lsService->phanTichTrangThai('light', $ov['avgLight']),
        ];

        return [
            'overview' => $ov,
            'status'   => $status,
            'devices'  => $this->tbService->hienThiTatCaThietBi()
        ];
    }
}