<?php
namespace App\Models;

class KhuVuc{
    public $idKhuVuc;
    public $maKhuVuc;
    public $tenKhuVuc;
    public $cheDo;
    public $moTa;
    public $soThietBi;

    public function __construct($data = [])
    {
        $this->idKhuVuc = $data['idKhuVuc'] ?? null;
        $this->maKhuVuc = $data['maKhuVuc'] ?? null;
        $this->tenKhuVuc = $data['tenKhuVuc'] ?? null;
        $this->cheDo = $data['cheDo'] ?? null;
        $this->moTa = $data['moTa'] ?? null;
        $this->soThietBi = $data['soThietBi'] ?? null;
    }
}
?>