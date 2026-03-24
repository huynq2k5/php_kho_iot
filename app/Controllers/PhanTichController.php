<?php

namespace App\Controllers;

use App\Services\ThietBiService;
use App\Services\LichSuCamBienService;

class PhanTichController extends BaseController{
    private $thietBiService;
    private $lichSuService;

    public function __construct()
    {
        parent::__construct();
        $this->thietBiService = new ThietBiService();
        $this->lichSuService = new LichSuCamBienService();
    }
    
    public function hienThiTrangPhanTich() {
        return $this->thietBiService->hienThiTatCaThietBi();
    }

    public function apiLayDuLieuBieuDo() {
        $idThietBi = $_GET['idThietBi'] ?? null;
        $period = $_GET['period'] ?? 'day';
        $sensorType = $_GET['sensorType'] ?? 'temp';

        $data = $this->lichSuService->layDuLieuVeBieuDo($idThietBi, $period, $sensorType);

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}