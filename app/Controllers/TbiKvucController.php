<?php
namespace  App\Controllers;
use App\Services\KhuVucService;
use App\Services\ThietBiService;
use App\Services\LichSuCamBienService;

class TbiKvucController extends BaseController{
    private $kvService;
    private $tbService;
    private $lsService;
    private $tpService;
    public function __construct()
    {
        parent::__construct();
        $this->kvService = new KhuVucService();
        $this->tbService = new ThietBiService();
        $this->lsService = new LichSuCamBienService();
        $this->tpService = new \App\Services\ThanhPhanThietBiService();
    }

    public function layDuLieuKhuVuc() {
        return $this->kvService->hienthiDSKhuVuc();
    }
    
    public function layDuLieuThietBi() {
        return $this->tbService->hienThiTatCaThietBi();
    }

    public function layThongTinSuaKhuVuc($id) {
        return $this->kvService->getKhuVucById($id);
    }

    public function layDuLieuCamBienTheoTB($id){
        return $this->lsService->layTatCaLichSu($id);
    }

    public function webThemKhuVuc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'maKhuVuc' => $_POST['maKhuVuc'] ?? null,
                'tenKhuVuc' => $_POST['tenKhuVuc'] ?? null,
                'cheDo'       => $_POST['cheDo'] ?? null,
                'moTa'      => $_POST['moTa'] ?? null,
            ];

            $kq = $this->kvService->themKhuVuc($data);

            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            header('Location: index.php?page=thietbi&tab=khuvuc');
            exit;
        }
    }

    public function webSuaKhuVuc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idKhuVuc'] ?? null;
            $data = [
                'tenKhuVuc' => $_POST['tenKhuVuc'] ?? null,
                'cheDo'       => $_POST['cheDo'] ?? null,
                'moTa'      => $_POST['moTa'] ?? null
            ];

            $kq = $this->kvService->suaKhuVuc($id, $data);

            $_SESSION['msg'] = ($kq !== false) ? 'edit_success' : 'edit_error';
            
            if ($kq !== false) {
                header('Location: index.php?page=thietbi&tab=khuvuc');
            } else {
                header('Location: index.php?page=khuvuc_sua&id=' . $id);
            }
            exit;
        }
    }

    public function webXoaKhuVuc() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $kq = $this->kvService->xoaKhuVuc($id);
            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=thietbi&tab=khuvuc');
            exit;
        }
    }

    public function webThemThietBi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maThietBi = $_POST['maThietBi'] ?? null;
            
            $dataTB = [
                'maThietBi' => $maThietBi,
                'tenThietBi' => $_POST['tenThietBi'] ?? null,
                'topicMQTT' => $_POST['topicMQTT'] ?? null,
                'idKhuVuc' => $_POST['idKhuVuc'] ?? null,
                'trangThai' => $_POST['trangThai'] ?? 1
            ];

            $this->tbService->themThietBi($dataTB);

            $idThietBi = $this->tbService->layIdThietBi($maThietBi);

            if ($idThietBi) {
                $mas = $_POST['tp_ma'] ?? [];
                $tens = $_POST['tp_ten'] ?? [];
                $loais = $_POST['tp_loai'] ?? [];
                $donvis = $_POST['tp_donvi'] ?? [];
                $gpios = $_POST['tp_gpio'] ?? [];

                foreach ($mas as $key => $ma) {
                    if (!empty($ma)) {
                        $dataTP = [
                            'idThietBi' => $idThietBi,
                            'maThanhPhan' => $ma,
                            'tenThanhPhan' => $tens[$key],
                            'loaiThanhPhan' => $loais[$key],
                            'donVi' => $donvis[$key],
                            'pinGPIO' => $gpios[$key]
                        ];
                        $this->tpService->themThanhPhan($dataTP);
                    }
                }
                $_SESSION['msg'] = 'add_success';
            } else {
                $_SESSION['msg'] = 'add_error';
            }
            
            header('Location: index.php?page=thietbi&tab=thietbi');
            exit;
        }
    }

    public function layThongTinSuaThietBi($id) {
        return $this->tbService->getThietBiById($id);
    }

    public function layDuLieuThanhPhan($idThietBi)
    {
        return $this->tpService->getThanhPhanTheoThietBi($idThietBi);
    }

    public function webSuaThietBi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idThietBi'] ?? null;
            
            // 1. Cập nhật thiết bị
            $dataTB = [
                'tenThietBi' => $_POST['tenThietBi'] ?? null,
                'topicMQTT' => $_POST['topicMQTT'] ?? null,
                'idKhuVuc' => $_POST['idKhuVuc'] ?? null,
                'trangThai' => isset($_POST['trangThai']) ? 1 : 0
            ];
            $kq = $this->tbService->suaThietBi($id, $dataTB);

            if ($kq !== false) {
                // 2. Xử lý thành phần: Xóa hết cũ - Thêm mới lại
                // Huy cần viết thêm hàm xoaThanhPhanTheoThietBi trong Service/Repo
                $this->tpService->xoaTatCaThanhPhanCuaThietBi($id); 

                $mas = $_POST['tp_ma'] ?? [];
                $tens = $_POST['tp_ten'] ?? [];
                $loais = $_POST['tp_loai'] ?? [];
                $donvis = $_POST['tp_donvi'] ?? [];
                $gpios = $_POST['tp_gpio'] ?? [];

                foreach ($mas as $key => $ma) {
                    if (!empty($ma)) {
                        $dataTP = [
                            'idThietBi' => $id,
                            'maThanhPhan' => $ma,
                            'tenThanhPhan' => $tens[$key],
                            'loaiThanhPhan' => $loais[$key],
                            'donVi' => $donvis[$key],
                            'pinGPIO' => $gpios[$key]
                        ];
                        $this->tpService->themThanhPhan($dataTP);
                    }
                }
                $_SESSION['msg'] = 'edit_success';
            } else {
                $_SESSION['msg'] = 'edit_error';
            }
            header('Location: index.php?page=thietbi_sua&id=' . $id);
            exit;
        }
    }

    public function webXoaThietBi() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $kq = $this->tbService->xoaThietBi($id);
            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=thietbi&tab=thietbi');
            exit;
        }
    }

    public function webXuatExcelLichSu() {
        $id = $_GET['id'] ?? null;
        if (!$id) exit("Không tìm thấy thiết bị");

        $tb = $this->tbService->getThietBiById($id);
        $lichSu = $this->lsService->layTatCaLichSu($id);

        // 1. Thiết lập Header để trình duyệt hiểu đây là file tải về
        $fileName = "LichSu_" . str_replace(' ', '_', $tb->tenThietBi) . "_" . date('Ymd_His') . ".csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $fileName);

        // 2. Mở luồng xuất file
        $output = fopen('php://output', 'w');

        // 3. Xử lý tiếng Việt cho Excel (BOM)
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // 4. Ghi dòng tiêu đề cột
        fputcsv($output, ['Thời gian', 'Nhiệt độ (°C)', 'Độ ẩm (%)', 'CO2 (ppm)', 'Ánh sáng (lux)']);

        // 5. Ghi dữ liệu
        if (!empty($lichSu)) {
            foreach ($lichSu as $ls) {
                fputcsv($output, [
                    date('d/m/Y H:i:s', strtotime($ls->thoiGian)),
                    $ls->nhietDo,
                    $ls->doAm,
                    $ls->nongDoCo2,
                    $ls->cuongDoAnhSang
                ]);
            }
        }

        fclose($output);
        exit;
    }
    
}
?>
