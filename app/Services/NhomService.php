<?php
namespace App\Services;
use App\Repositories\NhomRepository;

class NhomService{
    private $nhomRepo;
    public function __construct()
    {
        $this->nhomRepo = new NhomRepository();
    } 
    public function hienThiDSNhom(){
        $nhom = $this->nhomRepo->layTatCaNhom();
        return $nhom;
    }

    public function getRoleById($id) {
        $nhom = $this->nhomRepo->timNhomTheoId($id);
        return $nhom;
    }
}
?>