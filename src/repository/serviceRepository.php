<?php

namespace App\repository;

use \PDO;
use App\entity\service;

class serviceRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //CREATE
    public function create(service $service): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO service(description, price, time_) VALUES (:description, :price, :time)');
        $result = $stmt->execute([
            "description" => $service->getDescription(),
            "price" => $service->getPrice(),
            "time" => $service->getTime()
        ]);
        return $result;
    }


    //READ
    public function findById(int $id): ?service
    {
        $stmt = $this->pdo->prepare('SELECT * FROM service WHERE Id_service = :id');
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        }
        return new service(
            $result['description'],
            $result['price'],
            $result['time_'],
            $result['Id_service'],
        );
    }

    public function findAll(service $service): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM service');
        $stmt->execute();
        $stmt->fetchAll();
        $service = [];
        foreach ($stmt as $row) {
            $service[] = new service($row['Id_service'], $row['description'], $row['price'], $row['time_']);
        }
        return $service;
    }


    //UPDATE
    public function update(service $service): bool
    {
        $stmt = $this->pdo->prepare('UPDATE service SET description=:description, price=:price, time_=:time WHERE id=:id');
        $stmt->execute([
            "description" => $service->getDescription(),
            "price" => $service->getPrice(),
            "time" => $service->getTime(),
            "id" => $service->getIdService()
        ]);
        $result = $stmt;
        return $result;
    }

    //DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM service WHERE id=:id');
        $stmt->execute(["id" => $id]);
        $result = $stmt;
        return $result;
    }
}
