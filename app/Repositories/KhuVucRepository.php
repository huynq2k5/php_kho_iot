<?php
namespace App\Repositories;
use App\Models\KhuVuc;
use Config\KetNoi;

class KhuVucRepository {
    private $db;

    public function __construct() {
        $this->db = new KetNoi();
    }

    public function layTatCaKhuVuc() {
        $sql = "SELECT kv.*, COUNT(tb.idThietBi) as soThietBi 
                FROM khuvuc kv 
                LEFT JOIN thietbi tb ON tb.idKhuVuc = kv.idKhuVuc 
                GROUP BY kv.idKhuVuc";

        $kq = $this->db->truyVan($sql);

        $khuVuc = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $khuVuc[] = new KhuVuc($row);
            }
        }
        return $khuVuc;
    }

    public function layKhuVucTheoId($id){
        $sql = "SELECT * FROM khuvuc
                WHERE idKhuVuc = ?";
        
        $kq = $this->db->truyVan($sql, [$id]);
        
        if ($kq && $kq->num_rows > 0) {
            $row = $kq->fetch_assoc();
            return new KhuVuc($row);
        }
        
        return null;
    }

    public function insertKhuVuc($data) {
        $sql = "INSERT INTO khuvuc (maKhuVuc, tenKhuVuc, cheDo, moTa) 
                VALUES (?, ?, ?, ?)";
        
        return $this->db->capNhat($sql, [
            $data['maKhuVuc'],
            $data['tenKhuVuc'],
            $data['cheDo'],
            $data['moTa']
        ]);
    }

    public function updateKhuVuc($id, $data) {
        $sql = "UPDATE khuvuc 
                SET tenKhuVuc = ? , 
                    cheDo = ? , 
                    moTa = ? 
                WHERE idKhuVuc = ?";
        
        return $this->db->capNhat($sql, [
            $data['tenKhuVuc'],
            $data['cheDo'],
            $data['moTa'],
            $id
        ]);
    }

    public function deleteKhuVuc($id) {
        $sql = "DELETE FROM khuvuc WHERE idKhuVuc = ?";
        return $this->db->capNhat($sql, [$id]);
    }
}
?>