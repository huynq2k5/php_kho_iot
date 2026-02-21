<?php
namespace App\Repositories;

use Config\KetNoi;
use App\Models\User;

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = new KetNoi();
    }

    public function findByUsername($username) {
        $sql = "SELECT u.*, n.tenNhom as role_name 
                FROM nguoidung u 
                JOIN nhomnguoidung n ON u.idNhom = n.idNhom 
                WHERE u.tenDangNhap = ?";
        
        $result = $this->db->truyVan($sql, [$username]);
        $row = $result->fetch_assoc();

        if ($row) {
            return (object)$row; 
        }
        return null;
    }

    public function getPermissions($idNhom) {
        $sql = "SELECT q.maQuyen 
                FROM quyen q
                JOIN nhomnguoidung_quyen nq ON q.idQuyen = nq.idQuyen
                WHERE nq.idNhom = ?";
        $result = $this->db->truyVan($sql, [$idNhom]);
        
        $permissions = [];
        while ($row = $result->fetch_assoc()) {
            $permissions[] = $row['maQuyen'];
        }
        return $permissions;
    }

    public function layTatCaNguoiDung(){
        $sql = "SELECT u.*, n.tenNhom 
                FROM nguoidung u 
                JOIN nhomnguoidung n ON u.idNhom = n.idNhom ";
        $kq = $this->db->truyVan($sql);

        $user = [];
        if($kq && $kq->num_rows >0){
            while($row = $kq->fetch_assoc()){
                $user[] = (object)$row;
            }
        }
        return $user;
    }
}