<?php
namespace App\Services;
use App\Repositories\KhuVucRepository;

class KhuVucService{
    private $kvRepo;

    public function __construct()
    {
        $this->kvRepo = new KhuVucRepository();
    }

    public function hienthiDSKhuVuc(){
        return $this->kvRepo->layTatCaKhuVuc();
    }

    public function getKhuVucById($id){
        return $this->kvRepo->layKhuVucTheoId($id);
    }

    public function themKhuVuc($data) {        
        return $this->kvRepo->insertKhuVuc($data);
    }

    public function suaKhuVuc($id, $data) {
        return $this->kvRepo->updateKhuVuc($id, $data);
    }

    public function xoaKhuVuc($id) {
        return $this->kvRepo->deleteKhuVuc($id);
    }
}
?>