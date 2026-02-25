<?php

namespace App\Models;

class ThietBi
{
    public $idThietBi;
    public $maThietBi;
    public $tenThietBi;
    public $topicMQTT;
    public $idKhuVuc;
    public $trangThai;
    public $isOnline;
    public $tenKhuVuc;
    public $thoiGianCapNhat;

    public function __construct($data = [])
    {
        $this->idThietBi = $data['idThietBi'] ?? null;
        $this->maThietBi = $data['maThietBi'] ?? null;
        $this->tenThietBi = $data['tenThietBi'] ?? null;
        $this->topicMQTT = $data['topicMQTT'] ?? null;
        $this->idKhuVuc = $data['idKhuVuc'] ?? null;
        $this->tenKhuVuc = $data['tenKhuVuc'] ?? null;
        $this->trangThai = $data['trangThai'] ?? 0;
        $this->isOnline = $data['isOnline'] ?? null;
        $this->thoiGianCapNhat = $data['thoiGianCapNhat'] ?? null;
    }

    public function isOnline()
    {
        return $this->isOnline == 1;
    }

    public function isActive()
    {
        return $this->trangThai == 1;
    }
}