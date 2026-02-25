<?php
namespace App\Repositories;

use App\Models\ThietBi;
use Config\KetNoi;

class ThietBiRepository {
    private $db;

    public function __construct() {
        $this->db = new KetNoi();
    }

    public function layTatCaThietBi() {
        $sql = "SELECT t.*, k.tenKhuVuc 
                FROM thietbi t 
                LEFT JOIN khuvuc k ON t.idKhuVuc = k.idKhuVuc
                ORDER BY t.idThietBi DESC";
        
        $kq = $this->db->truyVan($sql);

        $dsThietBi = [];
        if($kq && $kq->num_rows > 0) {
            while($row = $kq->fetch_assoc()) {
                $dsThietBi[] = new ThietBi($row);
            }
        }
        return $dsThietBi;
    }

    public function layThietBiTheoId($id) {
        $sql = "SELECT t.*, k.idKhuVuc
                FROM thietbi t 
                LEFT JOIN khuvuc k ON t.idKhuVuc = k.idKhuVuc
                WHERE t.idThietBi = ?";
        
        $kq = $this->db->truyVan($sql, [$id]);
        
        if ($kq && $kq->num_rows > 0) {
            $row = $kq->fetch_assoc();
            return new ThietBi($row);
        }
        
        return null;
    }

    public function insertThietBi($data) {
        $sql = "INSERT INTO thietbi (maThietBi, tenThietBi, topicMQTT, idKhuVuc, trangThai) 
                VALUES (?, ?, ?, ?, ?)";
        
        return $this->db->capNhat($sql, [
            $data['maThietBi'],
            $data['tenThietBi'],
            $data['topicMQTT'] ?? null,
            $data['idKhuVuc'],
            $data['trangThai'] ?? 0
        ]);
    }

    public function updateThietBi($id, $data) {
        $sql = "UPDATE thietbi 
                SET tenThietBi = ?, 
                    topicMQTT = ?, 
                    idKhuVuc = ?, 
                    trangThai = ?
                WHERE idThietBi = ?";
        
        return $this->db->capNhat($sql, [
            $data['tenThietBi'],
            $data['topicMQTT'] ?? null,
            $data['idKhuVuc'],
            $data['trangThai'] ?? 0,
            $id
        ]);
    }

    public function deleteThietBi($id) {
        $sql = "DELETE FROM thietbi WHERE idThietBi = ?";
        return $this->db->capNhat($sql, [$id]);
    }

    public function timKiemThietBi($tuKhoa) {
        $sql = "SELECT t.*, k.tenKhuVuc 
                FROM thietbi t 
                LEFT JOIN khuvuc k ON t.idKhuVuc = k.idKhuVuc
                WHERE t.maThietBi LIKE ? 
                   OR t.tenThietBi LIKE ? 
                   OR t.loaiThietBi LIKE ?
                ORDER BY t.idThietBi DESC";
        
        $tuKhoa = "%{$tuKhoa}%";
        $kq = $this->db->truyVan($sql, [$tuKhoa, $tuKhoa, $tuKhoa]);

        $dsThietBi = [];
        if($kq && $kq->num_rows > 0) {
            while($row = $kq->fetch_assoc()) {
                $dsThietBi[] = new ThietBi($row);
            }
        }
        return $dsThietBi;
    }
}