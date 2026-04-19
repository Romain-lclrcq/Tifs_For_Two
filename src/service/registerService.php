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
        // Vérification de l'existence et de la validité du token
        if (!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']) {
            // Erreur 403 : Accès interdit ou tentative de fraude
            header('HTTP/1.1 403 Forbidden');
            exit("Erreur de sécurité : Jeton CSRF invalide.");
        }

        if (empty($data['firstname'])) {
            $err[] = 'Merci de renseigner votre prénom.';
        }
        if (empty($data['lastname'])) {
            $err[] = 'Merci de renseigner votre nom.';
        }
        if (empty($data['telNumber'])) {
            $err[] = 'Merci de renseigner votre numéro de téléphone.';
        }
        if (empty($data['mail'])) {
            $err[] = 'Merci de renseigner votre adresse mail.';
        }
        if (empty($data['password'])) {
            $err[] = 'Merci de renseigner votre mot de passe.';
        }

        $lastname = htmlspecialchars($data['lastname']);
        $firstname = htmlspecialchars($data['firstname']);


        //on supprime tous les caractères qui ne sont pas des chiffres, 
        //et on compte le nombre de caractere restant
        $tel_number =  preg_replace('/\D/', '', $data['telNumber']);
        if (strlen($tel_number) !== 10) {
            $err[] = 'Le numéro de téléphone est incorrect.';
        }
        var_dump(strlen($tel_number));
        if ($this->accountRepository->findByTelNumber($tel_number)) {
            $err[] = 'Le numéro de téléphone est déjà utilisé.';
        }


        //on controle si l'adresse mail existe déjà
        if ($this->accountRepository->findByMail($data['mail'])) {
            $err[] = 'Cette adresse email est déjà utilisée.';
        }
        $mail = filter_var($data['mail'], FILTER_VALIDATE_EMAIL);
        if ($mail === false) {
            $err[] = 'L\'adresse email n\'est pas valide.';
        }


        if ($data['password'] !== $data['confirmPassword']) {
            $err[] = 'Le mot de passe ne correspond pas à la confirmation.';
        }
        $hashedPassword = password_hash($data['password'], PASSWORD_ARGON2ID);


        $birthday = new DateTime($data['birthday']);
        $today = new DateTime();

        if (empty($birthday)) {
            $err[] = 'Merci de renseigner votre date de naissance.';
        }


        $interval = $today->diff($birthday);
        var_dump($interval);

        if (!$interval->y >= 18) {
            $err[] = 'Vous devez être majeur pour vous créer un compte.';
        }

        if (empty($err)) {

            $account = new account(
                $mail,
                $hashedPassword,
                $tel_number
            );

            $this->accountRepository->create($account);

            $idAccount = $this->accountRepository->findLastId();

            $customer = new customer(
                $lastname,
                $firstname,
                $birthday,
                $idAccount
            );
            $this->customerRepository->create($customer);

            return true;
        }
        return $err;
    }
}
