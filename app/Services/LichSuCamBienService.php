<?php
namespace App\Services;

use App\Repositories\LichSuCamBienRepository;

class LichSuCamBienService {
    private $lichSuRepo;

    public function __construct()
    {
        $this->lichSuRepo = new LichSuCamBienRepository();
    }

    public function layTatCaLichSu($idThietBi)
    {
        return $this->lichSuRepo->layLichSuTheoThietBi($idThietBi);
    }

    public function layThongSoMoiNhat($idThietBi)
    {
        return $this->lichSuRepo->layLichSuMoiNhat($idThietBi);
    }

    public function xoaToanBoLichSu($idThietBi)
    {
        return $this->lichSuRepo->xoaLichSuTheoThietBi($idThietBi);
    }

    public function ghiNhanDuLieu($data)
    {
        return $this->lichSuRepo->luuLichSu($data);
    }

    // Hàm tính EMA (Exponential Moving Average)
    private function calculateEMA($data, $period) {
        if (empty($data)) return [];
        $k = 2 / ($period + 1);
        $ema = [$data[0]];
        for ($i = 1; $i < count($data); $i++) {
            $ema[] = $data[$i] * $k + $ema[$i - 1] * (1 - $k);
        }
        return $ema;
    }

    // Hàm tính MACD
    public function getMACD($data) {
        $ema12 = $this->calculateEMA($data, 12);
        $ema26 = $this->calculateEMA($data, 26);
        
        $macdLine = [];
        foreach ($ema12 as $i => $val) {
            $macdLine[] = $val - $ema26[$i];
        }
        
        $signalLine = $this->calculateEMA($macdLine, 9);
        $histogram = [];
        foreach ($macdLine as $i => $val) {
            $histogram[] = $val - ($signalLine[$i] ?? 0);
        }

        return [
            'macd' => $macdLine,
            'signal' => $signalLine,
            'histogram' => $histogram
        ];
    }

    // Hàm tính RSI
    public function getRSI($data, $period = 14) {
        if (count($data) < $period) return array_fill(0, count($data), 50);
        
        $rsi = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($i < $period) {
                $rsi[] = 50; 
                continue;
            }
            
            $slice = array_slice($data, $i - $period, $period);
            $gains = 0; $losses = 0;
            for ($j = 1; $j < count($slice); $j++) {
                $diff = $slice[$j] - $slice[$j-1];
                if ($diff > 0) $gains += $diff; else $losses += abs($diff);
            }
            
            $rs = ($losses == 0) ? 100 : ($gains / $losses);
            $rsi[] = 100 - (100 / (1 + $rs));
        }
        return $rsi;
    }

    // App/Services/LichSuCamBienService.php

    public function layDuLieuVeBieuDo($idThietBi, $period, $sensorType) {
        $rawDataObjects = $this->lichSuRepo->layDuLieuBieuDo($idThietBi, $period);
        
        $labels = [];
        $values = [];

        foreach ($rawDataObjects as $item) {
            // TỰ ĐỘNG ĐỔI ĐỊNH DẠNG TRỤC OX THEO MỐC THỜI GIAN
            if ($period === 'week') {
                // Hiển thị: 24/03 15:00 (Để biết giờ trong tuần)
                $labels[] = date('d/m H:i', strtotime($item->thoiGian)); 
            } elseif ($period === 'month') {
                // Hiển thị: 24/03 (Vì tháng quá dài, hiện giờ sẽ bị rối)
                $labels[] = date('d/m', strtotime($item->thoiGian)); 
            } else {
                // Mặc định cho 'day': 15:00
                $labels[] = date('H:i', strtotime($item->thoiGian)); 
            }
            
            // Logic lấy giá trị cảm biến (Giữ nguyên như cũ)
            if (stripos($sensorType, 'temp') !== false || stripos($sensorType, 't') === 0) {
                $values[] = (float)$item->nhietDo;
            } elseif (stripos($sensorType, 'hum') !== false || stripos($sensorType, 'h') === 0) {
                $values[] = (float)$item->doAm;
            } elseif (stripos($sensorType, 'co2') !== false || stripos($sensorType, 'c') === 0) {
                $values[] = (float)$item->nongDoCo2;
            } else {
                $values[] = (float)$item->nhietDo;
            }
        }

        return [
            'labels' => $labels,
            'values' => $values,
            'macd' => $this->getMACD($values),
            'rsi' => $this->getRSI($values)
        ];
    }
}