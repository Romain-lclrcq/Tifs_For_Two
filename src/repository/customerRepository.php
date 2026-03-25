<?php

namespace App\repository;

use App\entity\customer;
use \PDO;
use \DateTime;

class customerRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //CREATE
    public function create(customer $customer): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO customer (lastname, firstname, birthday, Id_account) VALUES (:lastname, :firstname, :birthday, :Id_account)");
        $result = $stmt->execute([
            'lastname' => $customer->getLastname(),
            'firstname' => $customer->getFirstname(),
            'birthday' => $customer->getBirthday()->format('Y-m-d'),
            'Id_account' => $customer->getIdAccount()
        ]);

        return $result;
    }

    //READ
    public function findById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE Id_customer=:id");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        };
        $customer = new customer(
            $result['lastname'],
            $result['firstname'],
            new DateTime(
                $result['birthday']
            ),
            (int)$result['Id_account'],
            (int)$result['Id_Customer'],
        );
        return $customer;
    }

    public function findByLastname(string $lastname)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE lastname=:lastname");
        $stmt->execute(["lastname" => $lastname]);
        $result = $stmt->fetchAll();
        if (!$result) {
            return null;
        };
        $customer = [];
        foreach ($result as $user) {
            $birthday = new DateTime($user['birthday']);
            $customer[] = new customer(
                $user['lastname'],
                $user['firstname'],
                $birthday,
                (int)$user['Id_account'],
            );
        }
        return $customer;
    }

    public function findByFirstname(string $firstname)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE firstname=:firstname");
        $stmt->execute(["firstname" => $firstname]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        };
        $birthday = new DateTime($result['birthday']);

        $customer = new customer(
            $result['lastname'],
            $result['firstname'],
            $birthday,
            (int)$result['Id_account'],
        );
        return $customer;
    }

    public function findByIdAccount(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM customer WHERE Id_account=:Id_account');
        $stmt->execute(["Id_account" => $id]);
        $result = $stmt->fetchAll();

        $customer = [];
        foreach ($result as $user) {
            $birthday = new DateTime($user['birthday']);
            $customer[] = new customer(
                $user['lastname'],
                $user['firstname'],
                $birthday,
                (int)$user['Id_account'],
                (int)$user['Id_Customer']
            );
        }
        return $customer;
    }



    //UPDATE
    public function update(customer $customer): bool
    {
        $stmt = $this->pdo->prepare('UPDATE customer SET lastname=:lastname, firstname=:firstname, birthday=:birthday WHERE id_customer=:id_customer');
        $result = $stmt->execute([
            "lastname" => $customer->getLastname(),
            "firstname" => $customer->getFirstname(),
            "birthday" => $customer->getBirthday()->format('Y-m-d'),
            "id_customer" => $customer->getIdcustomer()
        ]);
        return $result;
    }

    //DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM customer WHERE Id_Customer=:id');
        $result = $stmt->execute(["id" => $id]);
        return $result;
    }
}
