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
        $account = $this->accountRepository->findByMail($data['mail']);

        if ($account) {
            if (password_verify($data['password'], $account->getPassword())) {
                $user = $this->customerRepository->findById($account->getIdAccount());
                $_SESSION['Id_account'] = $account->getIdAccount();



                return [$account, $user];
            }
        }
        return $_POST['error'];
    }
}
