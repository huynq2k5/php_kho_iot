<?php
namespace App\Repositories;
use App\Models\Nhom;
use Config\KetNoi;

class NhomRepository{
    private $db;

    public function __construct()
    {
        $this->db = new KetNoi();
    }

    public function layTatCaNhom(){
        $sql = "SELECT n.*, COUNT(u.idNguoiDung) AS soThanhVien 
                FROM nhomnguoidung n 
                LEFT JOIN nguoidung u ON u.idNhom = n.idNhom
                GROUP BY n.idNhom";

        $kq = $this->db->truyVan($sql);

        $nhom = [];
        if($kq && $kq->num_rows > 0){
            while ($row = $kq->fetch_assoc()){
                $nhom[] = (object)$row;
            }
        }
        return $nhom;
    }
}
?>