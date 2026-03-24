<?php

namespace App\Models;

class NhatKyHeThong
{
    public $idNhatKy;
    public $idNguoiDung;
    public $hoTen;
    public $hanhDong;
    public $loaiDoiTuong;
    public $idDoiTuong;
    public $giaTriCu;
    public $giaTriMoi;
    public $thoiGian;

    public function __construct($data = [])
    {
        $this->idNhatKy = $data['idNhatKy'] ?? null;
        $this->idNguoiDung = $data['idNguoiDung'] ?? null;
        $this->hoTen = $data['hoTen'] ?? null;
        $this->hanhDong = $data['hanhDong'] ?? null;
        $this->loaiDoiTuong = $data['loaiDoiTuong'] ?? null;
        $this->idDoiTuong = $data['idDoiTuong'] ?? null;
        $this->giaTriCu = $data['giaTriCu'] ?? null;
        $this->giaTriMoi = $data['giaTriMoi'] ?? null;
        $this->thoiGian = $data['thoiGian'] ?? null;
    }
}