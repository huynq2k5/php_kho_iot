<?php
namespace App\Services;
use App\Repositories\QuyenRepository;

class QuyenService{
    private $quyenRepo;

    public function __construct()
    {
        $this->quyenRepo = new QuyenRepository();
    }

    public function hienthiDSQuyen(){
        $quyen = $this->quyenRepo->layTatCaQuyen();
        return $quyen;
    }
}
?>