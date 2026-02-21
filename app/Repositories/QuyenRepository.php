<?php
namespace App\Repositories;
use App\Models\Quyen;
use Config\KetNoi;

class QuyenRepository {
    private $db;

    public function __construct() {
        $this->db = new KetNoi();
    }

    public function layTatCaQuyen() {
        $sql = "SELECT q.*, COUNT(nq.idNhom) as soNhom 
                FROM quyen q 
                LEFT JOIN nhomnguoidung_quyen nq ON q.idQuyen = nq.idQuyen 
                GROUP BY q.idQuyen";

        $kq = $this->db->truyVan($sql);

        $quyen = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $quyen[] = (object)$row;
            }
        }
        return $quyen;
    }
}
?>