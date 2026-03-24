<?php

namespace App\Controllers;

use App\Services\LogSecurityService;

abstract class BaseController
{
    protected $logSecurityService;

    public function __construct()
    {
        $this->logSecurityService = new LogSecurityService();
        $this->logSecurityService->ghiNhanTruyCap();
    }

    protected function render($view, $data = [])
    {
        extract($data);
        include_once "app/views/{$view}.php";
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}