<?php
namespace App\Services;

use App\Repositories\KichBanTuDongRepository;

class KichBanTuDongService {
    private $kichBanRepo;

    public function __construct()
    {
        $this->kichBanRepo = new KichBanTuDongRepository();
    }

    public function hienThiTatCaKichBan()
    {
        return $this->kichBanRepo->layTatCaKichBan();
    }

    public function getKichBanById($id)
    {
        return $this->kichBanRepo->layKichBanTheoId($id);
    }

    public function themKichBan($data)
    {
        return $this->kichBanRepo->insertKichBan($data);
    }

    public function suaKichBan($id, $data)
    {
        $kichBan = $this->kichBanRepo->layKichBanTheoId($id);
        if (!$kichBan) {
            return -1;
        }
        return $this->kichBanRepo->updateKichBan($id, $data);
    }

    public function xoaKichBan($id)
    {
        $kichBan = $this->kichBanRepo->layKichBanTheoId($id);
        if (!$kichBan) {
            return -1;
        }
        return $this->kichBanRepo->deleteKichBan($id);
    }

    public function thayDoiTrangThai($id, $trangThai)
    {
        $kichBan = $this->kichBanRepo->layKichBanTheoId($id);
        if (!$kichBan) {
            return -1;
        }
        return $this->kichBanRepo->toggleKichHoat($id, $trangThai);
    }

    public function phanLoaiKichBan()
    {
        $tatCa = $this->kichBanRepo->layTatCaKichBan();
        $ketQua = [
            'sensor' => [],
            'timer' => []
        ];

        foreach ($tatCa as $kb) {
            if ($kb->loaiKichBan === 'SENSOR') {
                $ketQua['sensor'][] = $kb;
            } else {
                $ketQua['timer'][] = $kb;
            }
        }

        return $ketQua;
    }

    public function voHieuHoaToanBoHeThong($isManual)
    {
        // 1. Nếu chuyển sang MANUAL (isManual = true) thì trangThai = 0 (tắt hết)
        $trangThai = $isManual ? 0 : 1; 
        $res = $this->kichBanRepo->updateTatCaTrangThai($trangThai);

        if ($res) {
            // 2. Gửi lệnh báo cho Bridge.js
            $mode = $isManual ? "MANUAL" : "AUTO";
            $url = "http://localhost:3001/set_mode?mode=" . $mode;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_exec($ch);
            curl_close($ch);
        }
        return $res;
    }

    public function isHeThongManual() {
        return $this->kichBanRepo->checkHeThongIsManual();
    }

    public function getTrangThai($id)
    {
        return $this->kichBanRepo->layTrangThaiKichBan($id);
    }
}