<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\entity\{account, appointment, customer, employe, service};
use App\repository\{accountRepository, appointmentRepository, customerRepository, employeRepository, serviceRepository, opinionRepository};
use App\service\{DatabaseFactory, registerFactory, registerService, loginService, dashboardService, opinionService, homeService};
use App\Controller\{E404Controller, homeController, serviceController, registerController, loginController, dashboardController, opinionController};


$request = trim($_SERVER['REQUEST_URI'], '/');
$params = explode('/', $request);
$controller = array_shift($params);
$method = array_shift($params);
if ($controller == '' || $controller == "home") {
    $controller = 'home';
}
if ($method == '') {
    $method = 'index';
}
$controllerClass = 'App\\Controller\\' . $controller . 'Controller'; // App/controller/homeController
if (!class_exists($controllerClass)) {
    $controllerClass = E404Controller::class; // App\controller\E404Controller
}

try {
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        throw new Exception("Configuration file (.env) is missing at project root.");
    }
    $config = parse_ini_file($envPath);
    $pdo = DatabaseFactory::create($config);
} catch (Exception $e) {
    error_log("Connection failed : " . $e->getMessage());
    echo "<br>" . $e->getMessage() . "<br>";
    echo $e->getFile();
    die('Une erreur technique est survenue. Veuillez réessayer plus tard.');
}

$container = [
    homeController::class => function ($pdo) {
        $opinionRepository = new opinionRepository($pdo);
        $customerRepository = new customerRepository($pdo);
        $appointmentRepository = new appointmentRepository($pdo);
        $homeService = new homeService($opinionRepository, $appointmentRepository, $customerRepository);
        return new homeController($homeService);
    },
    E404Controller::class => function ($pdo) {
        return new E404Controller();
    },
    serviceController::class => function ($pdo) {
        return new serviceController();
    },
    registerController::class => function ($pdo) {
        $customerRepository = new customerRepository($pdo);
        $accountRepository = new accountRepository($pdo);
        $registerService = new registerService($customerRepository, $accountRepository);
        return new registerController($registerService);
    },
    loginController::class => function ($pdo) {
        $accountRepository = new accountRepository($pdo);
        $customerRepository = new customerRepository($pdo);
        $loginService = new loginService($accountRepository, $customerRepository);
        return new loginController($loginService);
    },
    dashboardController::class => function ($pdo) {
        $accountRepository = new accountRepository($pdo);
        $customerRepository = new customerRepository($pdo);
        $appointmentRepository = new appointmentRepository($pdo);
        $employeRepository = new employeRepository($pdo);
        $serviceRepository = new serviceRepository($pdo);
        $dashboardService = new dashboardService($accountRepository, $customerRepository, $appointmentRepository, $employeRepository, $serviceRepository);
        return new dashboardController($dashboardService);
    },
    opinionController::class => function ($pdo) {
        $opinionRepository = new opinionRepository($pdo);
        $customerRepository = new customerRepository($pdo);
        $appointmentRepository = new appointmentRepository($pdo);
        $opinionService = new opinionService($opinionRepository, $appointmentRepository, $customerRepository);
        return new opinionController($opinionService);
    }
];



$controllerInstance = $container[$controllerClass]($pdo);
if (!method_exists($controllerInstance, $method)) {
    $method = 'index';
}

$controllerInstance->$method($params);
