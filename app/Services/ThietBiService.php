<?php
namespace App\Services;

use App\Repositories\ThietBiRepository;

class ThietBiService {
    private $thietBiRepo;

    public function __construct()
    {
        $this->thietBiRepo = new ThietBiRepository();
    }

    public function hienThiTatCaThietBi()
    {
        $dsThietBi = $this->thietBiRepo->layTatCaThietBi();
        return $dsThietBi;
    }

    public function getThietBiById($id)
    {
        $thietBi = $this->thietBiRepo->layThietBiTheoId($id);
        return $thietBi;
    }

    public function themThietBi($data)
    {
        return $this->thietBiRepo->insertThietBi($data);
    }

    public function suaThietBi($id, $data)
    {
        $thietBi = $this->thietBiRepo->layThietBiTheoId($id);
        if (!$thietBi)
            return -1;
        else
            return $this->thietBiRepo->updateThietBi($id, $data);
    }

    public function xoaThietBi($id)
    {
        $thietBi = $this->thietBiRepo->layThietBiTheoId($id);
        if (!$thietBi)
           return -1;

        else
            return $this->thietBiRepo->deleteThietBi($id);
        
    }

    public function timKiemThietBi($tuKhoa)
    {
        if (empty($tuKhoa)) {
            return $this->hienThiTatCaThietBi();
        }

        $dsThietBi = $this->thietBiRepo->timKiemThietBi($tuKhoa);
        return $dsThietBi;
    }
}