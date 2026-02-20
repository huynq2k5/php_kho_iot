<?php
namespace App\Services;

use App\Repositories\UserRepository;

class AuthService {
    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function authenticate($username, $password) {
        $user = $this->userRepo->findByUsername($username);

        if ($user && password_verify($password, $user->matKhau)) {
            $user->permissions = $this->userRepo->getPermissions($user->idNhom);
            return $user;
        }
        return null;
    }
}