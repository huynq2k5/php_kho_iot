<?php
namespace App\Models;

class User {
    public $idNguoiDung;
    public $tenDangNhap;
    public $matKhau;
    public $hoTen;
    public $idNhom;
    public $tenNhom;       // Tương ứng với role_name
    public $permissions;   // Mảng chứa các mã quyền (maQuyen)

    public function __construct($data = []) {
        $this->idNguoiDung = $data['idNguoiDung'] ?? null;
        $this->tenDangNhap = $data['tenDangNhap'] ?? null;
        $this->matKhau     = $data['matKhau'] ?? null;
        $this->hoTen       = $data['hoTen'] ?? null;
        $this->idNhom      = $data['idNhom'] ?? null;
        
        // Gán tên nhóm từ kết quả JOIN trong Repository
        $this->tenNhom     = $data['role_name'] ?? ($data['tenNhom'] ?? null);
        
        // Mảng quyền hạn sẽ được nạp từ AuthService
        $this->permissions = $data['permissions'] ?? [];
    }
}