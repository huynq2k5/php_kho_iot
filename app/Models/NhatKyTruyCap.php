<?php

namespace App\Models;

class NhatKyTruyCap
{
    public $idTruyCap;
    public $idNguoiDung;
    public $ipAddress;
    public $fingerprint;
    public $userAgent;
    public $method;
    public $requestUri;
    public $quocGia;
    public $thanhPho;
    public $isp;
    public $thoiGian;

    public function __construct($data = [])
    {
        $this->idTruyCap = $data['idTruyCap'] ?? null;
        $this->idNguoiDung = $data['idNguoiDung'] ?? null;
        $this->ipAddress = $data['ipAddress'] ?? null;
        $this->fingerprint = $data['fingerprint'] ?? null;
        $this->userAgent = $data['userAgent'] ?? null;
        $this->method = $data['method'] ?? null;
        $this->requestUri = $data['requestUri'] ?? null;
        $this->quocGia = $data['quocGia'] ?? 'Unknown';
        $this->thanhPho = $data['thanhPho'] ?? 'Unknown';
        $this->isp = $data['isp'] ?? 'Unknown';
        $this->thoiGian = $data['thoiGian'] ?? null;
    }
}