<?php

namespace App\repository;

use App\entity\account;
use \PDO;

class accountRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //CREATE
    public function create(account $account): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO account (mail, password, tel_number) VALUES (:mail, :password, :tel_number)');
        $result = $stmt->execute([
            'mail' => $account->getMail(),
            'password' => $account->getPassword(),
            'tel_number' => $account->getTelNumber()
        ]);
        return $result;
    }


    //READ
    public function findById(int $id): ?account
    {
        $stmt = $this->pdo->prepare("SELECT * FROM account WHERE Id_account=:id");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetch();
        if (!$result) return null;

        $account = new account(
            $result['mail'],
            $result['password'],
            $result['tel_number'],
            $result['Id_account']
        );

        return $account;
    }


    public function findByMail(string $mail): ?account
    {
        $stmt = $this->pdo->prepare("SELECT * FROM account WHERE mail=:mail");
        $stmt->execute(["mail" => $mail]);
        $result = $stmt->fetch();
        if (!$result) return null;
        $account = new account(
            $result['mail'],
            $result['password'],
            $result['tel_number'],
            (int)$result['Id_account']
        );


        return $account;
    }

    public function findLastId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }

    public function findByTelNumber($num): bool
    {
        $stmt = $this->pdo->prepare('SELECT 1 FROM account WHERE tel_number=:num');
        $result = $stmt->execute(["num" => $num]);

        return (bool) $result;
    }



    //UPDATE
    public function update(account $account): bool
    {
        $stmt = $this->pdo->prepare("UPDATE account SET mail=:mail, password=:password, tel_number=:tel_number WHERE Id_account=:id");
        $result = $stmt->execute([
            'mail' => $account->getMail(),
            'password' => $account->getPassword(),
            'tel_number' => $account->getTelNumber(),
            'id' => $account->getIdAccount()
        ]);
        return $result;
    }

    //DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM account WHERE Id_account=:id");
        $result = $stmt->execute([
            "id" => $id
        ]);
        return $result;
    }
}
