<?php

namespace App\Repositories;

use App\Models\KichBanTuDong;
use Config\KetNoi;

class KichBanTuDongRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new KetNoi();
    }

    public function layTatCaKichBan()
    {
        $sql = "SELECT k.*, 
                       tp1.tenThanhPhan AS tenThanhPhanVao, 
                       tp1.donVi AS donViVao, 
                       tp1.idThietBi AS idThietBiVao, 
                       tp2.idThietBi AS idThietBiRa, 
                       tp2.tenThanhPhan AS tenThanhPhanRa
                FROM kichban_tudong k
                LEFT JOIN thanhphan_thietbi tp1 ON k.idThanhPhanVao = tp1.idThanhPhan
                LEFT JOIN thanhphan_thietbi tp2 ON k.idThanhPhanRa = tp2.idThanhPhan
                ORDER BY k.idKichBan DESC";

        $kq = $this->db->truyVan($sql);

        $dsKichBan = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsKichBan[] = new KichBanTuDong($row);
            }
        }
        return $dsKichBan;
    }

    public function layKichBanTheoId($id)
    {
        $sql = "SELECT k.*, 
                       tp1.tenThanhPhan AS tenThanhPhanVao, 
                       tp1.donVi AS donViVao, 
                       tp1.idThietBi AS idThietBiVao, 
                       tp2.idThietBi AS idThietBiRa, 
                       tp2.tenThanhPhan AS tenThanhPhanRa
                FROM kichban_tudong k
                LEFT JOIN thanhphan_thietbi tp1 ON k.idThanhPhanVao = tp1.idThanhPhan
                LEFT JOIN thanhphan_thietbi tp2 ON k.idThanhPhanRa = tp2.idThanhPhan
                WHERE k.idKichBan = ?";

        $kq = $this->db->truyVan($sql, [$id]);

        if ($kq && $kq->num_rows > 0) {
            $row = $kq->fetch_assoc();
            return new KichBanTuDong($row);
        }

        return null;
    }

    public function insertKichBan($data)
    {
        $sql = "INSERT INTO kichban_tudong 
                (tenKichBan, loaiKichBan, idThanhPhanVao, dieuKien, giaTriNguong, 
                 thoiGianBat, thoiGianTat, idThanhPhanRa, hanhDong, kichHoat) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        return $this->db->capNhat($sql, [
            $data['tenKichBan'],
            $data['loaiKichBan'],
            $data['idThanhPhanVao'] ?? null,
            $data['dieuKien'] ?? null,
            $data['giaTriNguong'] ?? 0,
            $data['thoiGianBat'] ?? null,
            $data['thoiGianTat'] ?? null,
            $data['idThanhPhanRa'],
            $data['hanhDong'],
            $data['kichHoat'] ?? 1
        ]);
    }

    public function updateKichBan($id, $data)
    {
        $sql = "UPDATE kichban_tudong 
                SET tenKichBan = ?, 
                    loaiKichBan = ?, 
                    idThanhPhanVao = ?, 
                    dieuKien = ?, 
                    giaTriNguong = ?, 
                    thoiGianBat = ?, 
                    thoiGianTat = ?, 
                    idThanhPhanRa = ?, 
                    hanhDong = ?, 
                    kichHoat = ?
                WHERE idKichBan = ?";

        return $this->db->capNhat($sql, [
            $data['tenKichBan'],
            $data['loaiKichBan'],
            $data['idThanhPhanVao'] ?? null,
            $data['dieuKien'] ?? null,
            $data['giaTriNguong'] ?? 0,
            $data['thoiGianBat'] ?? null,
            $data['thoiGianTat'] ?? null,
            $data['idThanhPhanRa'],
            $data['hanhDong'],
            $data['kichHoat'] ?? 1,
            $id
        ]);
    }

    public function toggleKichHoat($id, $trangThai)
    {
        $sql = "UPDATE kichban_tudong SET kichHoat = ? WHERE idKichBan = ?";
        return $this->db->capNhat($sql, [$trangThai, $id]);
    }

    public function deleteKichBan($id)
    {
        $sql = "DELETE FROM kichban_tudong WHERE idKichBan = ?";
        return $this->db->capNhat($sql, [$id]);
    }

    public function updateTatCaTrangThai($trangThai)
    {
        $sql = "UPDATE kichban_tudong SET kichHoat = ?";
        return $this->db->capNhat($sql, [$trangThai]);
    }

    public function checkHeThongIsManual() {
        // Nếu có ít nhất 1 kịch bản đang bật (kichHoat = 1) -> Hệ thống là AUTO
        // Nếu tất cả đều tắt -> Hệ thống là MANUAL
        $sql = "SELECT COUNT(*) as count FROM kichban_tudong WHERE kichHoat = 1";
        $kq = $this->db->truyVan($sql);
        $row = $kq->fetch_assoc();
        return (int)$row['count'] === 0; 
    }

    public function layTrangThaiKichBan($id)
    {
        $sql = "SELECT kichHoat FROM kichban_tudong WHERE idKichBan = ?";
        $kq = $this->db->truyVan($sql, [$id]);
        if ($kq && $kq->num_rows > 0) {
            $row = $kq->fetch_assoc();
            return (int)$row['kichHoat'];
        }
        return 0;
    }   
}