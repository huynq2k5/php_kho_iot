<?php

namespace App\Services;

use App\Repositories\NhatKyHeThongRepository;

class NhatKyHeThongService {
    private $nhatKyRepo;

    public function __construct()
    {
        $this->nhatKyRepo = new NhatKyHeThongRepository();
    }

    public function hienThiTatCaNhatKy($limit = 100)
    {
        return $this->nhatKyRepo->layTatCaNhatKy($limit);
    }

    public function timKiemNhatKy($tuKhoa)
    {
        if (empty($tuKhoa)) {
            return $this->hienThiTatCaNhatKy();
        }
        return $this->nhatKyRepo->timKiemNhatKy($tuKhoa);
    }

    public function ghiNhatKyMoi($data)
    {
        return $this->nhatKyRepo->ghiLog($data);
    }

    public function donDepNhatKy($soNgay = 30)
    {
        return $this->nhatKyRepo->xoaNhatKyCu($soNgay);
    }
}