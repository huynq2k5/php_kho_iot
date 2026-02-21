<?php
namespace  App\Controllers;
use App\Services\UserService;
use App\Services\NhomService;
use App\Services\QuyenService;

class NguoiDungController{
    private $userService;
    private $nhomService;
    private $quyenService;
    public function __construct()
    {
        $this-> userService = new UserService();
        $this-> nhomService = new NhomService();
        $this-> quyenService = new QuyenService();
    }

    public function layDuLieuNguoiDung() {
        return $this->userService->hienThiUser();
    }

    public function layDuLieuNhom(){
        return $this->nhomService->hienThiDSNhom();
    }

    public function layDuLieuQuyen() {
        return $this->quyenService->hienthiDSQuyen();
    }
}
?>