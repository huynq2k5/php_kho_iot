<?php

namespace App\Services;

use App\Repositories\ThongBaoRepository;

class ThongBaoService
{
    private $thongBaoRepo;

    public function __construct()
    {
        $this->thongBaoRepo = new ThongBaoRepository();
    }

    public function layCanhBaoMoiNhat($limit = 10)
    {
        return $this->thongBaoRepo->layCanhBaoMoiNhat($limit);
    }

    public function layThongBaoCuaToi($idNguoiDung)
    {
        return $this->thongBaoRepo->layThongBaoTheoUser($idNguoiDung);
    }

    public function taoCanhBaoTuHeThong($idThietBi, $tieuDe, $noiDung, $idNguoiDung)
    {
        $data = [
            'tieuDe' => $tieuDe,
            'noiDung' => $noiDung,
            'loaiThongBao' => 'CanhBao',
            'idThietBi' => $idThietBi,
            'idNguoiDung' => $idNguoiDung
        ];
        return $this->thongBaoRepo->insertThongBao($data);
    }

    public function daDocThongBao($id)
    {
        return $this->thongBaoRepo->danhDauDaXem($id);
    }
}