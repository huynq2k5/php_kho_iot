<?php

namespace App\Models;

class KichBanTuDong
{
    public $idKichBan;
    public $tenKichBan;
    public $loaiKichBan;
    public $idThanhPhanVao;
    public $tenThanhPhanVao; 
    public $dieuKien;
    public $giaTriNguong;
    public $donViVao;
    public $thoiGianBat;
    public $thoiGianTat;
    public $idThanhPhanRa;
    public $tenThanhPhanRa; 
    public $hanhDong;
    public $kichHoat;
    public $idThietBiVao;
    public $idThietBiRa;

    public function __construct($data = [])
    {
        $this->idKichBan = $data['idKichBan'] ?? null;
        $this->tenKichBan = $data['tenKichBan'] ?? null;
        $this->loaiKichBan = $data['loaiKichBan'] ?? 'SENSOR';
        $this->idThanhPhanVao = $data['idThanhPhanVao'] ?? null;
        $this->tenThanhPhanVao = $data['tenThanhPhanVao'] ?? null;
        $this->dieuKien = $data['dieuKien'] ?? null;
        $this->giaTriNguong = $data['giaTriNguong'] ?? 0;
        $this->donViVao = $data['donViVao'] ?? '';
        $this->thoiGianBat = $data['thoiGianBat'] ?? null;
        $this->thoiGianTat = $data['thoiGianTat'] ?? null;
        $this->idThanhPhanRa = $data['idThanhPhanRa'] ?? null;
        $this->tenThanhPhanRa = $data['tenThanhPhanRa'] ?? null;
        $this->hanhDong = $data['hanhDong'] ?? 'ON';
        $this->kichHoat = $data['kichHoat'] ?? 1;
        $this->idThietBiVao = $data['idThietBiVao'] ?? null;
        $this->idThietBiRa = $data['idThietBiRa'] ?? null;
    }

    public function isActivated()
    {
        return $this->kichHoat == 1;
    }

    public function isSensorType()
    {
        return $this->loaiKichBan === 'SENSOR';
    }

    public function isTimerType()
    {
        return $this->loaiKichBan === 'TIMER';
    }

    public function getFormattedCondition()
    {
        if ($this->isTimerType()) {
            $bat = $this->thoiGianBat ? date("H:i", strtotime($this->thoiGianBat)) : '--:--';
            $tat = $this->thoiGianTat ? date("H:i", strtotime($this->thoiGianTat)) : '--:--';
            return "Từ " . $bat . " đến " . $tat;
        }
        
        return "NẾU " . $this->tenThanhPhanVao . " " . $this->dieuKien . " " . $this->giaTriNguong . $this->donViVao;
    }
}