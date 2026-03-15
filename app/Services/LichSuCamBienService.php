<?php
namespace App\Services;

use App\Repositories\LichSuCamBienRepository;

class LichSuCamBienService {
    private $lichSuRepo;

    public function __construct()
    {
        $this->lichSuRepo = new LichSuCamBienRepository();
    }

    public function layTatCaLichSu($idThietBi)
    {
        return $this->lichSuRepo->layLichSuTheoThietBi($idThietBi);
    }

    public function layThongSoMoiNhat($idThietBi)
    {
        return $this->lichSuRepo->layLichSuMoiNhat($idThietBi);
    }

    public function xoaToanBoLichSu($idThietBi)
    {
        return $this->lichSuRepo->xoaLichSuTheoThietBi($idThietBi);
    }

    public function ghiNhanDuLieu($data)
    {
        return $this->lichSuRepo->luuLichSu($data);
    }
}