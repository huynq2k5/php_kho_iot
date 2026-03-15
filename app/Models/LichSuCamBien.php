<?php

namespace App\Models;

class LichSuCamBien
{
    public $idDuLieu;
    public $idThietBi;
    public $nhietDo;
    public $doAm;
    public $nongDoCo2;
    public $cuongDoAnhSang;
    public $thoiGian;

    public function __construct($data = [])
    {
        $this->idDuLieu = $data['idDuLieu'] ?? null;
        $this->idThietBi = $data['idThietBi'] ?? null;
        $this->nhietDo = $data['nhietDo'] ?? 0.0;
        $this->doAm = $data['doAm'] ?? 0.0;
        $this->nongDoCo2 = $data['nongDoCo2'] ?? 0;
        $this->cuongDoAnhSang = $data['cuongDoAnhSang'] ?? 0;
        $this->thoiGian = $data['thoiGian'] ?? null;
    }
}