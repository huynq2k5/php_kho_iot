<?php
namespace App\Services;

use App\Repositories\ThanhPhanThietBiRepository;

class ThanhPhanThietBiService {
    private $tpRepo;

    public function __construct()
    {
        $this->tpRepo = new ThanhPhanThietBiRepository();
    }

    public function hienThiTatCaThanhPhan()
    {
        return $this->tpRepo->layTatCaThanhPhan();
    }

    public function getThanhPhanById($id)
    {
        return $this->tpRepo->layThanhPhanTheoId($id);
    }

    public function getThanhPhanTheoThietBi($idThietBi, $loai = null)
    {
        return $this->tpRepo->layThanhPhanTheoThietBi($idThietBi, $loai);
    }

    public function themThanhPhan($data)
    {
        return $this->tpRepo->insertThanhPhan($data);
    }

    public function suaThanhPhan($id, $data)
    {
        $thanhPhan = $this->tpRepo->layThanhPhanTheoId($id);
        if (!$thanhPhan) {
            return -1;
        }
        return $this->tpRepo->updateThanhPhan($id, $data);
    }

    public function xoaThanhPhan($id)
    {
        $thanhPhan = $this->tpRepo->layThanhPhanTheoId($id);
        if (!$thanhPhan) {
            return -1;
        }
        return $this->tpRepo->deleteThanhPhan($id);
    }

    public function layDanhSachPhanLoaiTheoThietBi($idThietBi)
    {
        $input = $this->tpRepo->layThanhPhanTheoThietBi($idThietBi, 'INPUT');
        $output = $this->tpRepo->layThanhPhanTheoThietBi($idThietBi, 'OUTPUT');

        return [
            'sensors' => $input,
            'actuators' => $output
        ];
    }
}