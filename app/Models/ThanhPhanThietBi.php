<?php

namespace App\Models;

class ThanhPhanThietBi
{
    public $idThanhPhan;
    public $idThietBi;
    public $maThanhPhan;
    public $tenThanhPhan;
    public $loaiThanhPhan;
    public $donVi;
    public $pinGPIO;
    public $tenThietBi; 

    public function __construct($data = [])
    {
        $this->idThanhPhan = $data['idThanhPhan'] ?? null;
        $this->idThietBi = $data['idThietBi'] ?? null;
        $this->maThanhPhan = $data['maThanhPhan'] ?? null;
        $this->tenThanhPhan = $data['tenThanhPhan'] ?? null;
        $this->loaiThanhPhan = $data['loaiThanhPhan'] ?? 'INPUT';
        $this->donVi = $data['donVi'] ?? null;
        $this->pinGPIO = $data['pinGPIO'] ?? null;
        $this->tenThietBi = $data['tenThietBi'] ?? null;
    }

    public function isInput()
    {
        return $this->loaiThanhPhan === 'INPUT';
    }

    public function isOutput()
    {
        return $this->loaiThanhPhan === 'OUTPUT';
    }

    public function formatValueWithUnit($value)
    {
        if ($this->donVi) {
            return $value . " " . $this->donVi;
        }
        return $value;
    }
}