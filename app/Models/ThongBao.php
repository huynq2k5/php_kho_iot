<?php

namespace App\Models;

class ThongBao
{
    public $idThongBao;
    public $tieuDe;
    public $noiDung;
    public $loaiThongBao;
    public $idThietBi;
    public $tenThietBi;
    public $idNguoiDung;
    public $daXem;
    public $thoiGian;

    public function __construct($data = [])
    {
        $this->idThongBao = $data['idThongBao'] ?? null;
        $this->tieuDe = $data['tieuDe'] ?? null;
        $this->noiDung = $data['noiDung'] ?? null;
        $this->loaiThongBao = $data['loaiThongBao'] ?? 'ThongTin';
        $this->idThietBi = $data['idThietBi'] ?? null;
        $this->tenThietBi = $data['tenThietBi'] ?? null;
        $this->idNguoiDung = $data['idNguoiDung'] ?? null;
        $this->daXem = $data['daXem'] ?? 0;
        $this->thoiGian = $data['thoiGian'] ?? null;
    }

    public function isUnread()
    {
        return $this->daXem == 0;
    }

    public function isWarning()
    {
        return $this->loaiThongBao === 'CanhBao';
    }
}