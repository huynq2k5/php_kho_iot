<?php

namespace App\Repositories;

use App\Models\ThongBao;
use Config\KetNoi;

class ThongBaoRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new KetNoi();
    }

    public function layCanhBaoMoiNhat($limit = 10)
    {
        $sql = "SELECT t.*, tb.tenThietBi 
                FROM thongbao t 
                LEFT JOIN thietbi tb ON t.idThietBi = tb.idThietBi 
                ORDER BY t.thoiGian DESC 
                LIMIT ?";
        
        $kq = $this->db->truyVan($sql, [$limit]);

        $dsThongBao = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsThongBao[] = new ThongBao($row);
            }
        }
        return $dsThongBao;
    }

    public function layTatCaThongBao(){
        $sql = "SELECT t.*, tb.tenThietBi 
                FROM thongbao t 
                LEFT JOIN thietbi tb ON t.idThietBi = tb.idThietBi 
                ORDER BY t.thoiGian DESC ";
        
        $kq = $this->db->truyVan($sql);

        $dsThongBao = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsThongBao[] = new ThongBao($row);
            }
        }
        return $dsThongBao;
    }

    public function layThongBaoTheoUser($idNguoiDung)
    {
        $sql = "SELECT t.*, tb.tenThietBi 
                FROM thongbao t 
                LEFT JOIN thietbi tb ON t.idThietBi = tb.idThietBi 
                WHERE t.idNguoiDung = ? 
                ORDER BY t.daXem ASC, t.thoiGian DESC";
        
        $kq = $this->db->truyVan($sql, [$idNguoiDung]);

        $dsThongBao = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsThongBao[] = new ThongBao($row);
            }
        }
        return $dsThongBao;
    }

    public function insertThongBao($data)
    {
        $sql = "INSERT INTO thongbao (tieuDe, noiDung, loaiThongBao, idThietBi, idNguoiDung, daXem) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        return $this->db->capNhat($sql, [
            $data['tieuDe'],
            $data['noiDung'],
            $data['loaiThongBao'],
            $data['idThietBi'] ?? null,
            $data['idNguoiDung'],
            $data['daXem'] ?? 0
        ]);
    }

    public function danhDauDaXem($id)
    {
        $sql = "UPDATE thongbao SET daXem = 1 WHERE idThongBao = ?";
        return $this->db->capNhat($sql, [$id]);
    }

    public function demThongBaoChuaDoc()
    {
        $sql = "SELECT COUNT(*) as total FROM thongbao WHERE daXem = 0";
        $result = $this->db->truyVan($sql);
        $row = $result->fetch_assoc();
        
        return (int)($row['total'] ?? 0);
    }

    public function xoaThongBao($id)
    {
        $sql = "DELETE FROM thongbao WHERE idThongBao = ?";
        return $this->db->capNhat($sql, [$id]);
    }
}