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

    public function ghiNhanDuLieu($data) {
        return $kq = $this->lichSuRepo->luuLichSu($data);
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
            if ($period === 'week') {
                $labels[] = date('d/m H:i', strtotime($item->thoiGian)); 
            } elseif ($period === 'month') {
                $labels[] = date('d/m', strtotime($item->thoiGian)); 
            } else {
                $labels[] = date('H:i', strtotime($item->thoiGian)); 
            }
            
            $type = strtolower($sensorType);
        
            if (stripos($type, 'temp') !== false || stripos($type, 't') === 0) {
                $values[] = (float)$item->nhietDo;
            } 
            elseif (stripos($type, 'hum') !== false || stripos($type, 'h') === 0) {
                $values[] = (float)$item->doAm;
            } 
            elseif (stripos($type, 'co2') !== false || stripos($type, 'c') === 0) {
                $values[] = (float)$item->nongDoCo2;
            } 
            // CẬP NHẬT: Thêm tiền tố 'as' và kiểm tra rộng hơn cho Ánh sáng
            elseif (stripos($type, 'light') !== false || 
                    stripos($type, 'l') === 0 || 
                    stripos($type, 'anhsang') !== false || 
                    stripos($type, 'as') !== false) {
                $values[] = (float)$item->cuongDoAnhSang;
            } 
            else {
                
                $values[] = 0.0; 
            }
        }

        return [
            'labels' => $labels,
            'values' => $values,
            'macd' => $this->getMACD($values),
            'rsi' => $this->getRSI($values)
        ];
    }

    public function layThongSoTrungBinhHeThong() {
        return $this->lichSuRepo->layTrungBinhMoiNhatHeThong();
    }

    public function phanTichTrangThai($loai, $giaTri) {
        switch ($loai) {
            case 'temp':

                if ($giaTri > 16) return ['text' => 'Quá nóng - Nguy cơ mọc mầm', 'class' => 'text-red-600'];
                if ($giaTri < 12) return ['text' => 'Quá lạnh - Nguy cơ hư hỏng lõi', 'class' => 'text-blue-500'];
                return ['text' => 'Nhiệt độ bảo quản lý tưởng', 'class' => 'text-green-600'];

            case 'hum':

                if ($giaTri > 95) return ['text' => 'Độ ẩm quá cao - Dễ nấm mốc', 'class' => 'text-red-500'];
                if ($giaTri < 80) return ['text' => 'Khoai đang mất nước (Héo)', 'class' => 'text-orange-600'];
                return ['text' => 'Độ ẩm đạt chuẩn', 'class' => 'text-green-600'];

            case 'co2':
                if ($giaTri > 2000) return ['text' => 'Nguy hiểm - Cần thông gió ngay', 'class' => 'text-red-700'];
                if ($giaTri > 1000) return ['text' => 'Nồng độ CO2 cao', 'class' => 'text-orange-500'];
                return ['text' => 'Không khí tốt', 'class' => 'text-teal-600'];

            case 'light':

                if ($giaTri > 50) return ['text' => 'Cảnh báo: Có ánh sáng lọt vào', 'class' => 'text-orange-500'];
                return ['text' => 'Độ tối đạt yêu cầu', 'class' => 'text-gray-500'];

            default:
                return ['text' => 'Đang theo dõi', 'class' => 'text-gray-400'];
        }
    }

    public function phanTichChiSo($values, $macdData, $rsiData, $sensorType) {
        // 1. Khởi tạo mảng dữ liệu mặc định để tránh lỗi Frontend
        $default = [
            'evaluation' => 'Đang thu thập dữ liệu... Hệ thống cần ít nhất 26 bản ghi để phân tích chính xác.',
            'suggestion' => 'Vui lòng chọn khoảng thời gian dài hơn hoặc chờ thiết bị cập nhật thêm.',
            'statusClass' => 'text-gray-400',
            'bgClass' => 'bg-gray-500',
            'lastRSI' => '--',
            'trendText' => '--',
            'momentum' => '--'
        ];

        // 2. Kiểm tra nếu mảng trống hoặc không đủ dữ liệu cho MACD/RSI
        if (empty($macdData['macd']) || empty($rsiData) || count($values) < 2) {
            return $default;
        }

        $lastRSI = end($rsiData);
        $lastMACD = end($macdData['macd']);
        $lastSignal = end($macdData['signal']);
        $lastHist = end($macdData['histogram']);

        $evaluation = "";
        $suggestion = "";
        $statusClass = "text-green-600";
        $bgClass = "bg-green-600";

        $isBullish = $lastMACD > $lastSignal;
        $trend = $isBullish ? "tăng" : "giảm";
        $momentum = abs($lastHist) > 0.1 ? "mạnh" : "yếu";

        if ($lastRSI > 70) {
            $statusClass = "text-red-600";
            $bgClass = "bg-red-600";
            $evaluation = "Xung lực biến động ở mức cực đại (RSI: " . round($lastRSI) . "). Xu hướng $trend đang diễn ra với động lượng $momentum.";
            $suggestion = $isBullish 
                ? "Đà tăng đang quá gắt. Cần can thiệp thiết bị để chặn đà tăng." 
                : "Xung lực cao nhưng xu hướng đang đảo chiều giảm. Theo dõi sát sao để đảm bảo không giảm quá đà.";
        } elseif ($lastRSI < 30) {
            $statusClass = "text-blue-600";
            $bgClass = "bg-blue-600";
            $evaluation = "Xung lực sụt giảm rơi vào vùng quá giới hạn (RSI: " . round($lastRSI) . "). Động lượng $trend đang chiếm ưu thế.";
            $suggestion = !$isBullish 
                ? "Hệ thống đang mất kiểm soát theo chiều hướng sụt giảm sâu. Cần kiểm tra ngay để tránh khoai lang bị héo hoặc thâm lõi." 
                : "Xung lực thấp đang có dấu hiệu hồi phục. Duy trì trạng thái để thông số quay lại vùng ổn định.";
        } else {
            $evaluation = "Trạng thái kỹ thuật ổn định (RSI: " . round($lastRSI) . "). MACD và Signal hội tụ cho thấy biến động không đáng kể.";
            $suggestion = "Động lượng biến động nằm trong ngưỡng an toàn. Hệ thống vận hành tự động ổn định.";
        }

        return [
            'evaluation' => $evaluation,
            'suggestion' => $suggestion,
            'statusClass' => $statusClass,
            'bgClass' => $bgClass,
            'lastRSI' => round($lastRSI),
            'trendText' => $trend,
            'momentum' => $momentum
        ];
    }
}