<?php

namespace App\controller;

use App\repository\serviceRepository;

class serviceController
{



    public function __construct() {}


    public function index(?array $params)
    {
        include __DIR__ . '/../../views/service.php';
    }
}
