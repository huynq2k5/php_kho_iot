<?php

namespace App\Services;

use App\Repositories\NhatKyTruyCapRepository;

class LogSecurityService {
    private $repo;

    public function __construct() {
        $this->repo = new NhatKyTruyCapRepository();
    }

    public function ghiNhanTruyCap() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if (strpos($uri, 'page=auth') === false) {
            return false;
        }

        $ip = $this->getRealIp();
        
        if (!isset($_SESSION['geo_data']) || $_SESSION['geo_ip'] !== $ip) {
            $_SESSION['geo_data'] = $this->getGeoInfo($ip);
            $_SESSION['geo_ip'] = $ip;
        }
        
        $geo = $_SESSION['geo_data'];
        
        $data = [
            'idNguoiDung' => null,
            'ipAddress'   => $ip,
            'fingerprint' => $_COOKIE['device_fingerprint'] ?? 'N/A',
            'userAgent'   => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'method'      => $method,
            'requestUri'  => $uri,
            'sessionId'   => session_id(),
            'quocGia'     => $geo['country'] ?? 'Unknown',
            'thanhPho'    => $geo['city'] ?? 'Unknown',
            'isp'         => $geo['isp'] ?? 'Unknown',
            'timezone'    => $geo['timezone'] ?? 'Asia/Ho_Chi_Minh'
        ];

        return $this->repo->luuTruyCap($data);
    }

    public function parseUserAgent($ua) {
        $os = "Unknown OS";
        $version = "Unknown Version";
        $browser = "Unknown Browser";
        
        // Mảng ánh xạ icon
        $osIcons = [
            'Windows' => 'fab fa-windows',
            'Android' => 'fab fa-android',
            'iOS'     => 'fab fa-apple',
            'Mac OS'  => 'fab fa-apple',
            'Linux'   => 'fab fa-linux'
        ];

        $browserIcons = [
            'Chrome'  => 'fab fa-chrome',
            'Edge'    => 'fab fa-edge',
            'Firefox' => 'fab fa-firefox',
            'Safari'  => 'fab fa-safari'
        ];

        $realOSVersion = $_COOKIE['os_real_version'] ?? null;

        if (preg_match('/Windows NT 10\.0/i', $ua)) {
            $os = 'Windows';
            $version = ($realOSVersion && version_compare($realOSVersion, '13.0.0', '>=')) ? '11' : '10';
        } elseif (preg_match('/Android ([0-9.]+)/i', $ua, $matches)) {
            $os = 'Android';
            $version = $matches[1];
        } elseif (preg_match('/iPhone/i', $ua)) {
            $os = 'iOS';
            $version = preg_match('/OS ([0-9_]+)/i', $ua, $matches) ? str_replace('_', '.', $matches[1]) : 'Version';
        }

        if (preg_match('/Edg\/([0-9.]+)/i', $ua)) {
            $browser = 'Edge';
        } elseif (preg_match('/Chrome\/([0-9.]+)/i', $ua)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Firefox\/([0-9.]+)/i', $ua)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Safari\/([0-9.]+)/i', $ua) && !preg_match('/Chrome/i', $ua)) {
            $browser = 'Safari';
        }

        return [
            'os'           => $os,
            'version'      => $version,
            'browser'      => $browser,
            'os_icon'      => $osIcons[$os] ?? 'fas fa-desktop',
            'browser_icon' => $browserIcons[$browser] ?? 'fas fa-globe'
        ];
    }

    public function layDanhSachTruyCap($limit = 10) {
        $dsTruyCap = $this->repo->layTatCaTruyCap($limit);
        foreach ($dsTruyCap as $item) {
            $item->phanGiaiUA = $this->parseUserAgent($item->userAgent);
        }
        return $dsTruyCap;
    }

    public function layTatCaTruyCap() {
        $dsTruyCap = $this->repo->layTruyCap();
        foreach ($dsTruyCap as $item) {
            $item->phanGiaiUA = $this->parseUserAgent($item->userAgent);
        }
        return $dsTruyCap;
    }

    public function layChiTietTruyCap($id) {
        $item = $this->repo->layTruyCapTheoId($id);
        if ($item) {
            $item->phanGiaiUA = $this->parseUserAgent($item->userAgent);
        }
        return $item;
    }

    private function getRealIp() {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    private function getGeoInfo($ip) {
        $url = "http://ip-api.com/json/{$ip}?fields=status,country,city,isp,timezone";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res, true);
    }
}