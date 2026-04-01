<?php
namespace  App\Controllers;
use App\Services\UserService;
use App\Services\NhomService;
use App\Services\QuyenService;

class NguoiDungController extends BaseController{
    private $userService;
    private $nhomService;
    private $quyenService;

    public function __construct()
    {
        parent::__construct();
        $this-> userService = new UserService();
        $this-> nhomService = new NhomService();
        $this-> quyenService = new QuyenService();
    }

    public function layDuLieuNguoiDung() {
        return $this->userService->hienThiUser();
    }
    public function layDuLieuNguoiDungBangId($id) {
        return $this->userService->getUserById($id);
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

    public function layThongTinSuaQuyen($id) {
        return $this->quyenService->getQuyenById($id);
    }

    public function layDSThanhVienNhom($id) {
        return $this->userService->getUserByIdRole($id);
    }

    public function layNguoiDungKhaDung($idNhom) {
        return $this->userService->getUserCoSan($idNhom);
    }

    public function htQuyenCuaNhom($id){
        return $quyenNhom = $this->quyenService->layQuyenDaGan($id);
    }

    public function webChuyenNhom() {
        $idNguoiDung = $_GET['idNguoiDung'] ?? null;
        $idNhomMoi = $_GET['idNhom'] ?? null;
    
        if ($idNguoiDung && $idNhomMoi) {
            $kq = $this->userService->chuyenNhomMoi($idNguoiDung, $idNhomMoi);
            
            $_SESSION['msg'] = $kq ? 'edit_success' : 'edit_error';
            
            $idNhomHienTai = $_GET['idNhomCu'] ?? $idNhomMoi; 
            header("Location: index.php?page=nhom_sua&id=" . $idNhomHienTai);
        } else {
            $_SESSION['msg'] = 'dulieu_khonghople';
            header('Location: index.php?page=users');
        }
        exit;
    }

    public function webSuaQuyen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idQuyen'] ?? null;
            $data = [
                'tenQuyen' => $_POST['tenQuyen'] ?? null
            ];

            $kq = $this->quyenService->suaQuyen($id, $data);

            $_SESSION['msg'] = ($kq !== false) ? 'edit_success' : 'edit_error';
            
            if ($kq !== false) {
                header('Location: index.php?page=users');
            } else {
                header('Location: index.php?page=quyen_sua&id=' . $id);
            }
            exit;
        }
    }

    public function webThemNguoiDung()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'maNguoiDung' => $_POST['maNguoiDung'] ?? null,
                'tenDangNhap' => $_POST['tenDangNhap'] ?? null,
                'hoTen'       => $_POST['hoTen'] ?? null,
                'idNhom'      => $_POST['idNhom'] ?? null,
                'matKhau'     => $_POST['matKhau'] ?? '12345678'
            ];

            $kq = $this->userService->themUser($data);

            if ($kq) {
                $this->logHeThong("Thêm người dùng mới: {$data['hoTen']}", "NGUOI_DUNG", $kq, null, $data);
            }

            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            header('Location: index.php?page=users');
            exit;
        }
    }

    public function webSuaNguoiDung()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idNguoiDung'] ?? null;
            $oldData = $this->userService->getUserById($id); // Lấy dữ liệu cũ để ghi log
            
            $data = [
                'tenDangNhap' => $_POST['tenDangNhap'] ?? null,
                'hoTen'       => $_POST['hoTen'] ?? null,
                'idNhom'      => $_POST['idNhom'] ?? null
            ];

            $kq = $this->userService->suaUser($id, $data);

            if ($kq !== false) {
                // GHI LOG: Cập nhật
                $this->logHeThong("Cập nhật thông tin người dùng: {$data['hoTen']}", "NGUOI_DUNG", $id, $oldData, $data);
            }

            $_SESSION['msg'] = ($kq !== false) ? 'edit_success' : 'edit_error';
            header('Location: index.php?page=users');
            exit;
        }
    }

    public function webXoaNguoiDung()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $oldData = $this->userService->getUserById($id);
            $kq = $this->userService->xoaUser($id);
            
            if ($kq) {
                // GHI LOG: Xóa
                $this->logHeThong("Xóa người dùng: {$oldData->hoTen}", "NGUOI_DUNG", $id, $oldData, null);
            }

            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=users');
            exit;
        }
    }

    public function webResetPass()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $user = $this->userService->getUserById($id);
            $kq = $this->userService->thucHienResetPass($id);
            
            if ($kq) {
                // GHI LOG: Bảo mật
                $this->logHeThong("Khôi phục mật khẩu mặc định cho: {$user->hoTen}", "NGUOI_DUNG", $id);
            }

            $_SESSION['msg'] = $kq ? 'res_thanhcong' : 'res_thatbai';
            header('Location: index.php?page=users');
            exit;
        }
    }

    public function webCapNhatThongTinCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user_id'] ?? null; 
            
            if ($id) {
                $userCu = $this->userService->getUserById($id);
                
                $data = [
                    'hoTen'       => $_POST['hoTen'] ?? $userCu->hoTen,
                    'tenDangNhap' => $userCu->tenDangNhap,
                    'idNhom'      => $userCu->idNhom
                ];

                $kq = $this->userService->suaUser($id, $data);

                if ($kq !== false) {
                    $_SESSION['user_name'] = $data['hoTen'];
                    $this->logHeThong("Cá nhân cập nhật thông tin", "NGUOI_DUNG", $id, $userCu, $data);
                }

                $_SESSION['msg'] = ($kq !== false) ? 'edit_success' : 'edit_error';
            }
            header('Location: index.php?page=profile');
            exit;
        }
    }

    public function webDoiMatKhauCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user_id'] ?? null;
            $matKhauCu = $_POST['old_password'] ?? '';
            $matKhauMoi = $_POST['new_password'] ?? '';
            $xacNhanMatKhau = $_POST['confirm_password'] ?? '';

            if ($matKhauMoi !== $xacNhanMatKhau) {
                $_SESSION['msg'] = 'pass_ko_khop'; 
                header('Location: index.php?page=profile');
                exit;
            }

            $kq = $this->userService->doiMatKhau($id, $matKhauCu, $matKhauMoi);

            if ($kq === true) {
                $this->logHeThong("Cá nhân thay đổi mật khẩu", "NGUOI_DUNG", $id);
                $_SESSION['msg'] = 'edit_success';
            } else {
                $_SESSION['msg'] = 'pass_sai'; 
            }

            header('Location: index.php?page=profile');
            exit;
        }
    }

    public function webThemNhom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'maNhom' => $_POST['maNhom'] ?? null,
                'tenNhom' => $_POST['tenNhom'] ?? null,
                'moTa'       => $_POST['moTa'] ?? null,
            ];

            $kq = $this->nhomService->themNhom($data);
            
            if ($kq) {
                $this->logHeThong("Thêm nhóm người dùng mới: {$data['tenNhom']}", "NGUOI_DUNG", $kq, null, $data);
            }

            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            header('Location: index.php?page=users&tab=groups');
            exit;
        }
    }

    public function webSuaNhom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idNhom'] ?? null;
            $oldData = $this->nhomService->getRoleById($id);

            $data = [
                'tenNhom' => $_POST['tenNhom'] ?? null,
                'moTa' => $_POST['moTa'] ?? null,
            ];
            
            $permissionIds = $_POST['permissions'] ?? [];
            $kqGroup = $this->nhomService->capNhatNhomVaQuyen($id, $data, $permissionIds);

            if ($kqGroup) {
                $this->logHeThong("Cập nhật thông tin và quyền cho nhóm: {$data['tenNhom']}", "NGUOI_DUNG", $id, $oldData, $data);
            }

            $_SESSION['msg'] = $kqGroup ? 'edit_success' : 'edit_error';
            header("Location: index.php?page=nhom_sua&id=" . $id);
            exit;
        }
    }

    public function webXoaNhom()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $oldData = $this->nhomService->getRoleById($id);
            $kq = $this->nhomService->xoaNhom($id);
            
            if ($kq) {
                $this->logHeThong("Xóa nhóm người dùng: {$oldData->tenNhom}", "NGUOI_DUNG", $id, $oldData, null);
            }

            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=users&tab=groups');
            exit;
        }
    }

    public function webThemQuyen()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'maQuyen' => $_POST['maQuyen'] ?? null,
                'tenQuyen' => $_POST['tenQuyen'] ?? null
            ];

            $kq = $this->quyenService->themQuyen($data);
            
            if ($kq) {
                $this->logHeThong("Định nghĩa quyền mới: {$data['tenQuyen']}", "NGUOI_DUNG", $kq, null, $data);
            }

            $_SESSION['msg'] = $kq ? 'add_success' : 'add_error';
            header('Location: index.php?page=users&tab=permissions');
            exit;
        }
    }

    public function webXoaQuyen()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $oldData = $this->quyenService->getQuyenById($id);
            $kq = $this->quyenService->xoaQuyen($id);
            
            if ($kq) {
                $this->logHeThong("Xóa quyền khỏi hệ thống: {$oldData->tenQuyen}", "NGUOI_DUNG", $id, $oldData, null);
            }

            $_SESSION['msg'] = $kq ? 'del_success' : 'del_error';
            header('Location: index.php?page=users&tab=permissions');
            exit;
        }
    }

    public function apiTimKiem() {
        $keyword = $_GET['keyword'] ?? '';
        $role = $_GET['role'] ?? ''; // Đây là idNhom từ select box

        $danhSachNguoiDung = $this->userService->timKiemNguoiDung($keyword, $role);
        
        // Nếu bạn muốn dùng AJAX, hãy trả về JSON
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json');
            echo json_encode($danhSachNguoiDung);
            exit;
        }

        return $danhSachNguoiDung;
    }
}
?>
