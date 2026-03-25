<?php

namespace App\service;

use App\repository\customerRepository;
use App\entity\customer;
use App\repository\accountRepository;
use App\entity\account;
use \DateTime;



class registerService
{
    private customerRepository $customerRepository;
    private accountRepository $accountRepository;


    public function __construct(customerRepository $customerRepository, accountRepository $accountRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->accountRepository = $accountRepository;
    }


    public function register(array $data)
    {

        // if ($this->customerRepository->findByLastname($data['lastname']) && $this->customerRepository->findByfirstname($data["firstname"])) {
        //     $err[] = "Le nom ET prénom sont déjà utilisés. Pas d'homonyme dans ma BDD.";
        //     // Un utilisateur a déjà le même nom et prénom (donc surement déjà un compte)
        // }
        $controleName = $this->customerRepository->findByLastname($data['lastname']);
        if ($controleName) {
            foreach ($controleName as $firstname) {
                if ($firstname->getFirstname() === $data["firstname"]) {
                    break;
                }
            }
            $err[] = 'Nous n\'acceptons pas les homonymes dans cette base de données. <br> Merci de rentrer chez vous :)';
        }


        //on supprime tous les caractères qui ne sont pas des chiffres, et on compte le nombre de caractere restant
        $tel_number =  preg_replace('/\D/', '', $data['telNumber']);
        if (strlen($tel_number) < 10 || strlen($tel_number) >= 14) {
            $err[] = 'Le numéro de téléphone est incorrect.';
        }

        if ($this->accountRepository->findByTelNumber($tel_number)) {
            $err[] = 'Le numéro de téléphone est déjà utilisé.';
        }


        //on controle si l'adresse mail existe déjà
        if ($this->accountRepository->findByMail($data['mail'])) {
            $err[] = 'Cette adresse mail est déjà utilisée.';
        }

        if ($data['password'] !== $data['confirmPassword']) {
            $err[] = 'Les mot de passe ne sosnt pas identiques.';
        }
        $hashedPassword = password_hash($data['password'], PASSWORD_ARGON2ID);


        $birthday = new DateTime($data['birthday']);
        $today = new DateTime();

        $interval = $today->diff($birthday);

        if (!$interval->y >= 18) {
            $err[] = 'T\'es pas majeur ';
        }

        if (empty($err)) {

            $account = new account(
                $data['mail'],
                $hashedPassword,
                $tel_number
            );

            $this->accountRepository->create($account);

            $idAccount = $this->accountRepository->findLastId();
            var_dump($idAccount);

            $customer = new customer(
                $data['lastname'],
                $data['firstname'],
                $birthday,
                $idAccount
            );
            $this->customerRepository->create($customer);

            return true;
        }
        return $err;
    }
}
