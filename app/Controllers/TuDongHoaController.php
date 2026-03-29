<?php
namespace App\Controllers;

use App\Services\KichBanTuDongService;
use App\Services\ThietBiService;
use App\Services\ThanhPhanThietBiService;
use App\Repositories\KichBanTuDongRepository;

class TuDongHoaController extends BaseController{
    private $kbService;
    private $tbService;
    private $tpService;
    private $kbRepo;

    public function __construct()
    {
        parent::__construct();
        $this->kbService = new KichBanTuDongService();
        $this->tbService = new ThietBiService();
        $this->tpService = new ThanhPhanThietBiService();
        $this->kbRepo = new KichBanTuDongRepository();
    }

    public function layThongTinSuaKichBan($id){
        return $this->kbService->getKichBanById($id);
    }

    public function layDuLieuTrangChu() {
        return $this->kbService->phanLoaiKichBan();
    }

    public function layDanhSachThietBi() {
        return $this->tbService->hienThiTatCaThietBi();
    }

    // 4. API TRẢ VỀ JSON CHO AJAX GIAO DIỆN
    public function apiLayThanhPhan() {
        $idThietBi = $_GET['idThietBi'] ?? null;
        $loai = $_GET['loai'] ?? null; // 'INPUT' hoặc 'OUTPUT'
        
        $dsThanhPhan = $this->tpService->getThanhPhanTheoThietBi($idThietBi, $loai);
        
        header('Content-Type: application/json');
        echo json_encode($dsThanhPhan);
        exit;
    }

    public function webThemKichBan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tenKichBan'      => $_POST['tenKichBan'] ?? null,
                'loaiKichBan'     => $_POST['loaiKichBan'] ?? 'SENSOR',
                // CẬP NHẬT: Lưu ID thành phần thay vì ID thiết bị chung chung
                'idThanhPhanVao'  => $_POST['idThanhPhanVao'] ?: null, 
                'dieuKien'        => $_POST['dieuKien'] ?? null,
                'giaTriNguong'    => $_POST['giaTriNguong'] ?? 0,
                'thoiGianBat'     => $_POST['thoiGianBat'] ?: null,
                'thoiGianTat'     => $_POST['thoiGianTat'] ?: null,
                'idThanhPhanRa'   => $_POST['idThanhPhanRa'] ?? null,
                'hanhDong'        => $_POST['hanhDong'] ?? 'ON',
                'kichHoat'        => isset($_POST['kichHoat']) ? 1 : 0
            ];

            $kq = $this->kbService->themKichBan($data);
            if ($kq) {
                $this->logHeThong("Thêm kịch bản tự động mới: {$data['tenKichBan']}", "KICH_BAN", 0, null, $data);
            }
            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            header('Location: index.php?page=tudong');
            exit;
        }
    }

    public function webSuaKichBan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idKichBan'] ?? null;
            $oldData = $this->kbService->getKichBanById($id);
            $data = [
                'tenKichBan'      => $_POST['tenKichBan'] ?? null,
                'loaiKichBan'     => $_POST['loaiKichBan'] ?? 'SENSOR',
                'idThanhPhanVao'  => $_POST['idThanhPhanVao'] ?: null,
                'dieuKien'        => $_POST['dieuKien'] ?? null,
                'giaTriNguong'    => $_POST['giaTriNguong'] ?? 0,
                'thoiGianBat'     => $_POST['thoiGianBat'] ?: null,
                'thoiGianTat'     => $_POST['thoiGianTat'] ?: null,
                'idThanhPhanRa'   => $_POST['idThanhPhanRa'] ?? null,
                'hanhDong'        => $_POST['hanhDong'] ?? 'ON',
                'kichHoat'        => isset($_POST['kichHoat']) ? 1 : 0
            ];

            $kq = $this->kbService->suaKichBan($id, $data);
            if ($kq !== -1) {
                $this->logHeThong("Cập nhật kịch bản: {$data['tenKichBan']}", "KICH_BAN", $id, $oldData, $data);
            }
            $_SESSION['msg'] = ($kq !== -1) ? 'edit_success' : 'edit_error';
            header('Location: index.php?page=tudong');
            exit;
        }
    }

    public function webXoaKichBan() {
        $id = $_GET['id'] ?? null;
        $oldData = $this->kbService->getKichBanById($id);
        if ($id) {
            $kq = $this->kbService->xoaKichBan($id);
            if ($kq !== -1) {
                $this->logHeThong("Xóa kịch bản tự động: " . ($oldData->tenKichBan ?? $id), "KICH_BAN", $id, $oldData, null);
            }
            $_SESSION['msg'] = ($kq !== -1) ? 'del_success' : 'del_error';
            header('Location: index.php?page=tudong');
            exit;
        }
    }

    public function apiLayTrangThaiTatCa() {
        $dsKichBan = $this->kbService->hienThiTatCaKichBan();
        $dataStatus = [];
        foreach ($dsKichBan as $kb) {
            $dataStatus[$kb->idKichBan] = $kb->kichHoat;
        }
        header('Content-Type: application/json');
        echo json_encode($dataStatus);
        exit;
    }

    public function apiToggleKichBan() {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? 0;
        $result = $this->kbService->thayDoiTrangThai($id, $status);
        
        if ($result) {
            $url = "http://localhost:3001/capnhatkichban?id=" . $id;
            @file_get_contents($url);
            $trangThai = ($status == 1) ? "Kích hoạt" : "Hủy kích hoạt";
            $this->logHeThong("$trangThai kịch bản ID: $id", "KICH_BAN", $id);
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => (bool)$result]);
        exit;
    }
}