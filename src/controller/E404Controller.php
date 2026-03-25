<?php

namespace App\controller;

class E404Controller
{
    public function __construct() {}

    public function index()
    {
        include __DIR__ . '/../../views/e404.php';
    }
}
