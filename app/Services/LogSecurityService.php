<?php

namespace App\Services;

use App\Repositories\NhatKyTruyCapRepository;

class LogSecurityService {
    private $repo;

    public function __construct() {
        $this->repo = new NhatKyTruyCapRepository();
    }

    public function ghiNhanTruyCap() {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // Gọi API lấy địa lý (Nên dùng cache để tránh làm chậm web)
        $geo = $this->getGeoInfo($ip);

        $data = [
            'idNguoiDung' => $_SESSION['user_id'] ?? null,
            'ipAddress'   => $ip,
            'fingerprint' => $_COOKIE['device_fingerprint'] ?? 'N/A',
            'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            'method'      => $_SERVER['REQUEST_METHOD'],
            'requestUri'  => $_SERVER['REQUEST_URI'],
            'quocGia'     => $geo['country'] ?? 'Unknown',
            'thanhPho'    => $geo['city'] ?? 'Unknown',
            'isp'         => $geo['isp'] ?? 'Unknown'
        ];

        return $this->repo->luuTruyCap($data);
    }

    private function getGeoInfo($ip) {
        $url = "http://ip-api.com/json/{$ip}?fields=status,country,city,isp";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2); // Chỉ đợi tối đa 2s
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res, true);
    }

    public function layDanhSachTruyCap($limit = 10) {
        return $this->repo->layTatCaTruyCap($limit);
    }
}