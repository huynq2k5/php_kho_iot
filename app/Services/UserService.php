<?php
namespace App\Services;
use App\Repositories\UserRepository;

class UserService{
    private $userRepo;
    public function __construct(){
        $this->userRepo = new UserRepository();
    }
    public function hienThiUser() {
        $users = $this->userRepo->layTatCaNguoiDung();

        foreach ($users as $user) {
            if (isset($user->idNhom)) {
                $user->permissions = $this->userRepo->getPermissions($user->idNhom);
            } else {
                $user->permissions = [];
            }
        }

        return $users;
    }
}
?>