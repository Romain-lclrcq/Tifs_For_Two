<?php

namespace App\controller;

use App\service\opinionService;

class opinionController
{

    private opinionService $opinionService;

    public function __construct(opinionService $opinionService)
    {
        $this->opinionService = $opinionService;
    }

    public function index()
    {
        $opinions = $this->opinionService->index();
        include __DIR__ . '/../../views/opinion.php';

        unset($_SESSION['err']);
    }

    public function publication()
    {
        $result = $this->opinionService->publication($_POST);


        if ($result) {
            $_SESSION['err'] = $result;
            header('location: /opinion');
        }
    }
}
