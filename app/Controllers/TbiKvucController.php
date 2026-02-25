<?php
namespace  App\Controllers;
use App\Services\KhuVucService;
use App\Services\ThietBiService;

class TbiKvucController{
    private $kvService;
    private $tbService;
    public function __construct()
    {
        $this-> kvService = new KhuVucService();
        $this->tbService = new ThietBiService();
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
            $data = [
                'maThietBi' => $_POST['maThietBi'] ?? null,
                'tenThietBi' => $_POST['tenThietBi'] ?? null,
                'topicMQTT' => $_POST['topicMQTT'] ?? null,
                'idKhuVuc' => $_POST['idKhuVuc'] ?? null,
                'trangThai' => isset($_POST['trangThai']) ? 1 : 0
            ];

            $kq = $this->tbService->themThietBi($data);
            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            
            header('Location: index.php?page=thietbi&tab=thietbi');
            exit;
        }
    }

    public function layThongTinSuaThietBi($id) {
        return $this->tbService->getThietBiById($id);
    }

    public function webSuaThietBi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idThietBi'] ?? null;
            
            $data = [
                'tenThietBi' => $_POST['tenThietBi'] ?? null,
                'topicMQTT' => $_POST['topicMQTT'] ?? null,
                'idKhuVuc' => $_POST['idKhuVuc'] ?? null,
                'trangThai' => isset($_POST['trangThai']) ? 1 : 0
            ];

            $kq = $this->tbService->suaThietBi($id, $data);
            
            $_SESSION['msg'] = $kq ? 'edit_success' : 'edit_error';
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
    
}
?>
