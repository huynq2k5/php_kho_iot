<?php

namespace App\Repositories;

use App\Models\LichSuCamBien;
use Config\KetNoi;

class LichSuCamBienRepository {
    private $db;

    public function __construct() {
        $this->db = new KetNoi();
    }

    public function layLichSuTheoThietBi($idThietBi) {
        $sql = "SELECT * FROM lichsucambien 
                WHERE idThietBi = ? 
                ORDER BY thoiGian DESC";
        
        $kq = $this->db->truyVan($sql, [$idThietBi]);

        $dsLichSu = [];
        if($kq && $kq->num_rows > 0) {
            while($row = $kq->fetch_assoc()) {
                $dsLichSu[] = new LichSuCamBien($row);
            }
        }
        return $dsLichSu;
    }

    public function layLichSuMoiNhat($idThietBi) {
        $sql = "SELECT * FROM lichsucambien 
                WHERE idThietBi = ? 
                ORDER BY thoiGian DESC 
                LIMIT 1";
        
        $kq = $this->db->truyVan($sql, [$idThietBi]);

        if($kq && $kq->num_rows > 0) {
            $row = $kq->fetch_assoc();
            return new LichSuCamBien($row);
        }
        return null;
    }

    public function layDuLieuBieuDo($idThietBi, $period = 'day') {
        $dateCondition = "";
        switch ($period) {
            case 'week':
                $dateCondition = "AND thoiGian >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
                break;
            case 'month':
                $dateCondition = "AND thoiGian >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
                break;
            default: // day
                $dateCondition = "AND thoiGian >= CURDATE()";
                break;
        }

        $sql = "SELECT * FROM lichsucambien 
                WHERE idThietBi = ? $dateCondition 
                ORDER BY thoiGian ASC";
        
        $kq = $this->db->truyVan($sql, [$idThietBi]);
        $dsLichSu = [];
        if($kq && $kq->num_rows > 0) {
            while($row = $kq->fetch_assoc()) {
                $dsLichSu[] = new LichSuCamBien($row);
            }
        }
        return $dsLichSu;
    }

    public function xoaLichSuTheoThietBi($idThietBi) {
        $sql = "DELETE FROM lichsucambien WHERE idThietBi = ?";
        return $this->db->capNhat($sql, [$idThietBi]);
    }

    public function luuLichSu($data) {
        $sql = "INSERT INTO lichsucambien (idThietBi, nhietDo, doAm, nongDoCo2, cuongDoAnhSang, thoiGian) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        
        return $this->db->capNhat($sql, [
            $data['idThietBi'],
            $data['nhietDo'],
            $data['doAm'],
            $data['nongDoCo2'],
            $data['cuongDoAnhSang']
        ]);
    }

    public function layTrungBinhMoiNhatHeThong() {
        // Truy vấn lấy bản ghi mới nhất của mỗi idThietBi, sau đó tính trung bình cộng
        $sql = "SELECT 
                    AVG(nhietDo) as avgTemp, 
                    AVG(doAm) as avgHum, 
                    AVG(nongDoCo2) as avgCo2, 
                    AVG(cuongDoAnhSang) as avgLight 
                FROM lichsucambien 
                WHERE (idThietBi, thoiGian) IN (
                    SELECT idThietBi, MAX(thoiGian) 
                    FROM lichsucambien 
                    GROUP BY idThietBi
                )";
        
        $kq = $this->db->truyVan($sql);
        if ($kq && $kq->num_rows > 0) {
            return $kq->fetch_assoc();
        }
        return [
            'avgTemp' => 0, 'avgHum' => 0, 'avgCo2' => 0, 'avgLight' => 0
        ];
    }
}