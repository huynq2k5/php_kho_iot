<?php
namespace  App\Controllers;
use App\Services\UserService;
use App\Services\NhomService;
use App\Services\QuyenService;

class NguoiDungController{
    private $userService;
    private $nhomService;
    private $quyenService;
    public function __construct()
    {
        $this-> userService = new UserService();
        $this-> nhomService = new NhomService();
        $this-> quyenService = new QuyenService();
    }

    public function layDuLieuNguoiDung() {
        return $this->userService->hienThiUser();
    }

    public function layDuLieuNhom(){
        return $this->nhomService->hienThiDSNhom();
    }

    public function layDuLieuQuyen() {
        return $this->quyenService->hienthiDSQuyen();
    }

    public function layThongTinSua($id) {
        $user = $this->userService->getUserById($id);

        $danhSachNhom = $this->nhomService->hienThiDSNhom();

        return [
            'user' => $user,
            'danhSachNhom' => $danhSachNhom
        ];
    }

    public function layThongTinSuaNhom($id) {
        return $this->nhomService->getRoleById($id);
    }

    public function webThemNguoiDung() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'maNguoiDung' => $_POST['maNguoiDung'] ?? null,
                'tenDangNhap' => $_POST['tenDangNhap'] ?? null,
                'hoTen'       => $_POST['hoTen'] ?? null,
                'idNhom'      => $_POST['idNhom'] ?? null,
                'matKhau'     => $_POST['matKhau'] ?? '12345678'
            ];

            $kq = $this->userService->themUser($data);

            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            header('Location: index.php?page=users');
            exit;
        }
    }

    public function webSuaNguoiDung() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idNguoiDung'] ?? null;
            $data = [
                'tenDangNhap' => $_POST['tenDangNhap'] ?? null,
                'hoTen'       => $_POST['hoTen'] ?? null,
                'idNhom'      => $_POST['idNhom'] ?? null
            ];

            $kq = $this->userService->suaUser($id, $data);

            $_SESSION['msg'] = ($kq !== false) ? 'edit_success' : 'edit_error';
            
            if ($kq !== false) {
                header('Location: index.php?page=users');
            } else {
                header('Location: index.php?page=nguoidung_sua&id=' . $id);
            }
            exit;
        }
    }

    public function webXoaNguoiDung() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $kq = $this->userService->xoaUser($id);
            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=users');
            exit;
        }
    }

    public function webResetPass(){
        $id = $_GET['id'] ?? null;
        if($id){
            $kq = $this->userService->thucHienResetPass($id);
            $_SESSION['msg'] = $kq ? 'res_thanhcong' : 'res_thatbai';
            header('Location: index.php?page=users');
            exit;
        }
    }
}
?>