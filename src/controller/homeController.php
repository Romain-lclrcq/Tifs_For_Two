<?php

namespace App\Controller;

use App\service\homeService;


class homeController
{
    private homeService $homeService;

    public function __construct(homeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $opinions = $this->homeService->index();
        include __DIR__ . '/../../views/home.php';
    }
}
