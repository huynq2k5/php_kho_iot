<?php

namespace App\Repositories;

use App\Models\NhatKyHeThong;
use Config\KetNoi;

class NhatKyHeThongRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new KetNoi();
    }

    public function layTatCaNhatKy($limit = 100)
    {
        $sql = "SELECT n.*, u.hoTen 
                FROM nhatkyhethong n 
                LEFT JOIN nguoidung u ON n.idNguoiDung = u.idNguoiDung
                ORDER BY n.thoiGian DESC 
                LIMIT ?";
        
        $kq = $this->db->truyVan($sql, [$limit]);

        $dsNhatKy = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsNhatKy[] = new NhatKyHeThong($row);
            }
        }
        return $dsNhatKy;
    }

    public function layNhatKy()
    {
        $sql = "SELECT n.*, u.hoTen 
                FROM nhatkyhethong n 
                LEFT JOIN nguoidung u ON n.idNguoiDung = u.idNguoiDung
                ORDER BY n.thoiGian DESC ";
        
        $kq = $this->db->truyVan($sql);

        $dsNhatKy = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsNhatKy[] = new NhatKyHeThong($row);
            }
        }
        return $dsNhatKy;
    }

    public function ghiLog($data)
    {
        $sql = "INSERT INTO nhatkyhethong (idNguoiDung, hanhDong, loaiDoiTuong, idDoiTuong, giaTriCu, giaTriMoi) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        return $this->db->capNhat($sql, [
            $data['idNguoiDung'],
            $data['hanhDong'],
            $data['loaiDoiTuong'],
            $data['idDoiTuong'],
            $data['giaTriCu'] ?? null,
            $data['giaTriMoi'] ?? null
        ]);
    }

    public function xoaNhatKyCu($soNgay = 30)
    {
        $sql = "DELETE FROM nhatkyhethong WHERE thoiGian < DATE_SUB(NOW(), INTERVAL ? DAY)";
        return $this->db->capNhat($sql, [$soNgay]);
    }

    public function timKiemNhatKy($tuKhoa)
    {
        $sql = "SELECT n.*, u.hoTen 
                FROM nhatkyhethong n 
                LEFT JOIN nguoidung u ON n.idNguoiDung = u.idNguoiDung
                WHERE n.hanhDong LIKE ? 
                   OR n.loaiDoiTuong LIKE ? 
                   OR u.hoTen LIKE ?
                ORDER BY n.thoiGian DESC";
        
        $tuKhoa = "%{$tuKhoa}%";
        $kq = $this->db->truyVan($sql, [$tuKhoa, $tuKhoa, $tuKhoa]);

        $dsNhatKy = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsNhatKy[] = new NhatKyHeThong($row);
            }
        }
        return $dsNhatKy;
    }
}