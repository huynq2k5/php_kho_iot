<?php

namespace App\Repositories;

use Config\KetNoi;
use App\Models\NhatKyTruyCap;

class NhatKyTruyCapRepository
{
    private $db;

    public function __construct() {
        $this->db = new KetNoi();
    }

    public function luuTruyCap($data) {
        $sql = "INSERT INTO nhatky_truycap (idNguoiDung, ipAddress, fingerprint, userAgent, method, requestUri, quocGia, thanhPho, isp) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        return $this->db->capNhat($sql, [
            $data['idNguoiDung'],
            $data['ipAddress'],
            $data['fingerprint'],
            $data['userAgent'],
            $data['method'],
            $data['requestUri'],
            $data['quocGia'],
            $data['thanhPho'],
            $data['isp']
        ]);
    }

    public function layTatCaTruyCap($limit = 10) {
        $sql = "SELECT * FROM nhatky_truycap ORDER BY thoiGian DESC LIMIT ?";
        
        $kq = $this->db->truyVan($sql, [$limit]);
        $dsTruyCap = [];

        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsTruyCap[] = new NhatKyTruyCap($row);
            }
        }
        return $dsTruyCap;
    }
}