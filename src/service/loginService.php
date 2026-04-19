<?php

namespace App\service;

use App\repository\accountRepository;
use App\repository\customerRepository;
use app\entity\account;

class loginService
{

    private accountRepository $accountRepository;
    private customerRepository $customerRepository;

    public function __construct(accountRepository $accountRepository, customerRepository $customerRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->customerRepository = $customerRepository;
    }

    public function modal()
    {
        include __DIR__ . '/../../templates/modalLogin.php';
    }

    public function login(array $data)
    {


        // Vérification de l'existence et de la validité du token
        if (!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']) {
            // Erreur 403 : Accès interdit ou tentative de fraude
            header('HTTP/1.1 403 Forbidden');
            exit("Erreur de sécurité : Jeton CSRF invalide.");
        }

        $mail = filter_var($data['mail'], FILTER_VALIDATE_EMAIL);

        $account = $this->accountRepository->findByMail($mail);

        if (!$account || !password_verify($data['password'], $account->getPassword())) {
            return false;
        }
        $user = $this->customerRepository->findById($account->getIdAccount());
        $_SESSION['Id_account'] = $account->getIdAccount();



        return [$account, $user];
    }
}
