<?php

namespace App\Controllers;

class CanhBaoNhatKyController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function layDuLieuManHinhChinh() {
        return [
            'canhBao' => $this->thongBaoService->layCanhBaoMoiNhat(10),
            'nhatKy'  => $this->nhatKyService->hienThiTatCaNhatKy(20),
            'truyCap' => $this->logSecurityService->layDanhSachTruyCap(10)
        ];
    }

    public function webHienThiChiTietTruyCap() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?page=alert_log');
            exit;
        }

        $access = $this->logSecurityService->layChiTietTruyCap($id);
        
        if (!$access) {
            header('Location: index.php?page=alert_log');
            exit;
        }

        return $access;
    }

    public function webXoaLichSuCu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $soNgay = $_POST['soNgay'] ?? 30;
            $kq = $this->nhatKyService->donDepNhatKy($soNgay);

            $this->logHeThong("Dọn dẹp nhật ký hệ thống cũ hơn {$soNgay} ngày", "CAU_HINH", 0);

            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=alert_log');
            exit;
        }
    }

    public function webXuatBaoCaoTongHop() {
        $canhBao = $this->thongBaoService->layTatCaCanhBao(); 
        $nhatKy = $this->nhatKyService->layTatCaNhatKy();      
        $truyCap = $this->logSecurityService->layTatCaTruyCap();    

        $fileName = "BaoCao_TongThe_Kho_IoT_" . date('Ymd_His') . ".csv";
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $output = fopen('php://output', 'w');

        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, ['--- 1. DANH SÁCH CẢNH BÁO CHI TIẾT ---']);
        fputcsv($output, [
            'ID', 'Thời gian', 'Thiết bị', 'Tiêu đề', 'Nội dung', 'Phân loại', 'Trạng thái'
        ]);
        foreach ($canhBao as $cb) {
            fputcsv($output, [
                $cb->idThongBao,
                date('d/m/Y H:i:s', strtotime($cb->thoiGian)),
                $cb->tenThietBi ?: 'N/A',
                $cb->tieuDe,
                $cb->noiDung,
                ($cb->loaiThongBao === 'CanhBao' ? 'Khẩn cấp' : 'Thông tin'),
                ($cb->daXem == 1 ? 'Đã xem' : 'Chưa xem')
            ]);
        }

        fputcsv($output, []); 
        fputcsv($output, ['--- 2. NHẬT KÝ HỆ THỐNG ---']);
        fputcsv($output, [
            'ID', 'Thời gian', 'Người thực hiện', 'Hành động', 'Loại đối tượng', 'ID Đối tượng', 'Giá trị cũ', 'Giá trị mới'
        ]);
        foreach ($nhatKy as $log) {
            fputcsv($output, [
                $log->idNhatKy,
                date('d/m/Y H:i:s', strtotime($log->thoiGian)),
                $log->hoTen ?: 'Hệ thống',
                $log->hanhDong,
                $log->loaiDoiTuong,
                $log->idDoiTuong,
                $log->giaTriCu,
                $log->giaTriMoi
            ]);
        }

        fputcsv($output, []);
        fputcsv($output, ['--- 3. NHẬT KÝ TRUY CẬP ---']);
        fputcsv($output, [
            'ID', 'Thời gian', 'IP Address', 'Quốc gia', 'Thành phố', 'ISP', 'Phương thức', 'Yêu cầu (URI)', 'Thiết bị (User Agent)', 'Fingerprint', 'Session ID'
        ]);
        foreach ($truyCap as $access) {
            fputcsv($output, [
                $access->idTruyCap,
                date('d/m/Y H:i:s', strtotime($access->thoiGian)),
                $access->ipAddress,
                $access->quocGia,
                $access->thanhPho,
                $access->isp,
                $access->method,
                $access->requestUri,
                $access->userAgent,
                $access->fingerprint,
                $access->sessionId
            ]);
        }

        fclose($output);
        exit;
    }

    public function webDocThongBao()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->thongBaoService->daDocThongBao($id);
        }

        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php?page=dashboard';
        header("Location: $referer");
        exit;
    }

    public function apiDocThongBao()
    {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;
        $kq = false;

        if ($id) {
            $kq = $this->thongBaoService->daDocThongBao($id);
        }

        echo json_encode([
            'success' => $kq,
            'message' => $kq ? 'Da danh dau' : 'Loi thuc thi'
        ]);
        exit;
    }

    public function webSLChuaDoc()
    {
        header('Content-Type: application/json');
        $count = $this->thongBaoService->getSoLuongChuaDoc();
        
        echo json_encode([
            'success' => true,
            'unread_count' => (int)$count
        ]);
        exit;
    }
}