<?php

namespace App\Repositories;

use App\Models\ThanhPhanThietBi;
use Config\KetNoi;

class ThanhPhanThietBiRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new KetNoi();
    }

    public function layTatCaThanhPhan()
    {
        $sql = "SELECT tp.*, t.tenThietBi 
                FROM thanhphan_thietbi tp
                LEFT JOIN thietbi t ON tp.idThietBi = t.idThietBi
                ORDER BY tp.idThanhPhan DESC";

        $kq = $this->db->truyVan($sql);

        $dsThanhPhan = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsThanhPhan[] = new ThanhPhanThietBi($row);
            }
        }
        return $dsThanhPhan;
    }

    public function layThanhPhanTheoThietBi($idThietBi, $loai = null)
    {
        $sql = "SELECT * FROM thanhphan_thietbi WHERE idThietBi = ?";
        $params = [$idThietBi];

        if ($loai) {
            $sql .= " AND loaiThanhPhan = ?";
            $params[] = $loai;
        }

        $kq = $this->db->truyVan($sql, $params);
        $dsThanhPhan = [];
        if ($kq && $kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                $dsThanhPhan[] = new ThanhPhanThietBi($row);
            }
        }
        return $dsThanhPhan;
    }

    public function layThanhPhanTheoId($id)
    {
        $sql = "SELECT tp.*, t.tenThietBi 
                FROM thanhphan_thietbi tp
                LEFT JOIN thietbi t ON tp.idThietBi = t.idThietBi
                WHERE tp.idThanhPhan = ?";

        $kq = $this->db->truyVan($sql, [$id]);

        if ($kq && $kq->num_rows > 0) {
            $row = $kq->fetch_assoc();
            return new ThanhPhanThietBi($row);
        }
        return null;
    }

    public function insertThanhPhan($data)
    {
        $sql = "INSERT INTO thanhphan_thietbi (idThietBi, maThanhPhan, tenThanhPhan, loaiThanhPhan, donVi, pinGPIO) 
                VALUES (?, ?, ?, ?, ?, ?)";

        return $this->db->capNhat($sql, [
            $data['idThietBi'],
            $data['maThanhPhan'],
            $data['tenThanhPhan'],
            $data['loaiThanhPhan'],
            $data['donVi'] ?? null,
            $data['pinGPIO'] ?? null
        ]);
    }

    public function updateThanhPhan($id, $data)
    {
        $sql = "UPDATE thanhphan_thietbi 
                SET maThanhPhan = ?, 
                    tenThanhPhan = ?, 
                    loaiThanhPhan = ?, 
                    donVi = ?, 
                    pinGPIO = ?
                WHERE idThanhPhan = ?";

        return $this->db->capNhat($sql, [
            $data['maThanhPhan'],
            $data['tenThanhPhan'],
            $data['loaiThanhPhan'],
            $data['donVi'] ?? null,
            $data['pinGPIO'] ?? null,
            $id
        ]);
    }

    public function deleteThanhPhan($id)
    {
        $sql = "DELETE FROM thanhphan_thietbi WHERE idThanhPhan = ?";
        return $this->db->capNhat($sql, [$id]);
    }
    public function deleteByDevice($idThietBi)
    {
        $sql = "DELETE FROM thanhphan_thietbi WHERE idThietBi = ?";
        return $this->db->capNhat($sql, [$idThietBi]);
    }
}