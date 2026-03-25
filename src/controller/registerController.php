<?php

namespace App\controller;

use App\service\registerService;

class registerController
{
    private registerService $registerService;

    public function __construct(registerService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index(?array $errors = [])
    {
        include __DIR__ . '/../../views/register.php';
    }

    public function modal($url, $success, $result)
    {
        include __DIR__ . '/../../views/templates/modalRegister.php';
    }


    public function register(): void
    {
        $result = $this->registerService->register($_POST);

        if ($result === true) {
            $this->index();
            $this->modal('/login', true, $result);
        } else {
            $this->index($result);
            $this->modal('/register', false, $result);
        }
    }
}
