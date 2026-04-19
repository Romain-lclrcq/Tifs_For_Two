<?php

namespace App\controller;

use App\service\loginService;

class loginController
{

    private loginService $loginService;

    public function __construct(loginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        include __DIR__ . '/../../views/login.php';
        unset($_SESSION['error']);
    }

    public function login(): void
    {
        $result = $this->loginService->login($_POST);

        if ($result) {
            header('Location: /dashboard');
            exit();
        } else {
            $_SESSION['error'] = 'Identifiant ou Mot de passe incorrect';
            header('Location:/login');
            exit;
        }
    }
}
