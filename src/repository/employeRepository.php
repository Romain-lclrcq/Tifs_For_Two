<?php

namespace App\repository;

use App\entity\employe;
use \PDO;

class employeRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //CREATE
    public function create(employe $employe): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO employe (firstname) VALUES (:firstname)');
        $result = $stmt->execute(["firstname" => $employe->getFirstname()]);
        return $result;
    }

    //READ
    public function findById(int $id): ?employe
    {
        $stmt = $this->pdo->prepare('SELECT * FROM employe WHERE Id_employe = :id');
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return new employe(
            $result['firstname'],
            (int)$result['Id_employe']
        );
    }

    public function showAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM employe');
        $stmt->execute();
        $stmt->fetchAll();
        $employe = [];
        foreach ($stmt as $row) {
            $employe[] = new employe($row['firstname'], $row['Id-employe']);
        }
        return $employe;
    }

    //UPDATE
    public function update(employe $employe): bool
    {
        $stmt = $this->pdo->prepare('UPDATE employe SET firstname=:firstname WHERE Id_employe=:id');
        $result = $stmt->execute([
            "firstname" => $employe->getFirstname(),
            "id" => $employe->getIdEmploye()
        ]);
        return $result;
    }

    //DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM employe WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        return $result;
    }
}
