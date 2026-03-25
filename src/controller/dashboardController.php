<?php

namespace App\controller;

use App\service\dashboardService;

class dashboardController
{

    private dashboardService $dashboardService;

    public function __construct(dashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }


    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['IdCustomer']) && !isset($_POST['delete'])) {
            (int)$id = $_POST['IdCustomer'];
            $userUpdate = $this->dashboardService->findCustomerById($id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['IdCustomer']) && isset($_POST['delete'])) {
            (int)$id = $_POST['IdCustomer'];
            $userDelete = $this->dashboardService->deleteCustomerById($id);
            header('location:/dashboard');
            exit;
        }



        if (!empty($_SESSION['Id_account'])) {
            $this->dashboardService->index();
            include __DIR__ . '/../../views/dashboard.php';
        } else {
            include __DIR__ . '/../../views/home.php';
        }
    }

    public function disconnect()
    {
        header('location: http://tifsfortwo.local/home');
        $this->dashboardService->disconnect();
    }

    public function update()
    {
        $this->dashboardService->update($_POST);
        header('location:/dashboard');
        exit;
    }

    public function create()
    {
        $userCreate = $this->dashboardService->create($_POST);
        header('location:/dashboard');
        exit;
    }

    // IF jre recoiit une requete en POST ET que mon $post id nest pas vide = je lance maboite de dialog




}
