<?php

namespace App\Services;

use App\Repositories\NhatKyTruyCapRepository;

class LogSecurityService {
    private $repo;

    public function __construct() {
        $this->repo = new NhatKyTruyCapRepository();
    }

    /**
     * Hàm lấy IP thật của người dùng (vượt qua Proxy/Cloudflare)
     */
    private function getRealIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Ghi nhận lượt truy cập vào Database
     */
    public function ghiNhanTruyCap() {
        // Đảm bảo session đã chạy để lấy được ID
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $ip = $this->getRealIp();
        
        // Localhost test: Nếu IP là loopback, dùng IP ảo để test GeoIP
        $lookupIp = ($ip === '127.0.0.1' || $ip === '::1') ? '113.161.127.234' : $ip;
        $geo = $this->getGeoInfo($lookupIp);

        $data = [
            'idNguoiDung' => $_SESSION['user_id'] ?? null,
            'ipAddress'   => $ip,
            'fingerprint' => $_COOKIE['device_fingerprint'] ?? 'N/A',
            'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            'method'      => $_SERVER['REQUEST_METHOD'],
            'requestUri'  => $_SERVER['REQUEST_URI'],
            'sessionId'   => session_id(),
            'quocGia'     => $geo['country'] ?? 'Unknown',
            'thanhPho'    => $geo['city'] ?? 'Unknown',
            'isp'         => $geo['isp'] ?? 'Unknown',
            'timeZone'    => $geo['timezone'] ?? 'Asia/Ho_Chi_Minh'
        ];

        return $this->repo->luuTruyCap($data);
    }

    /**
     * Gọi API lấy thông tin địa lý
     */
    private function getGeoInfo($ip) {
        // Thêm trường 'timezone' vào API
        $url = "http://ip-api.com/json/{$ip}?fields=status,country,city,isp,timezone";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3); // Tăng lên 3s để ổn định hơn trên host
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res, true);
    }

    /**
     * Lấy danh sách nhật ký truy cập để hiển thị
     */
    public function layDanhSachTruyCap($limit = 10) {
        return $this->repo->layTatCaTruyCap($limit);
    }
}