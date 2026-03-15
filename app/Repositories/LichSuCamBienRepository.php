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
}