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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['firstname'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $telNumber = $_POST['telNumber'];
            $mail = $_POST['mail'];
        } else {
            $firstname = '';
            $lastname = '';
            $mail = '';
            $telNumber = '';
        }

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
