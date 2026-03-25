<?php

namespace App\repository;

use App\entity\opinion;
use \DateTime;
use \PDO;

class opinionRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //CREATE
    public function create(opinion $opinion): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO opinion (commentary, date_publication, note, id_appointment)
            VALUES (:commentary, :date_publication, :note, :id_appointment)
            '
        );
        $result = $stmt->execute([
            'commentary' => $opinion->getCommentary(),
            'date_publication' => $opinion->getDatePublication(),
            'note' => $opinion->getNote(),
            'id_appointment' => $opinion->getIdAppointment()
        ]);
        return $result;
    }

    //READ
    public function findById(int $id): ?opinion
    {
        $stmt = $this->pdo->prepare('SELECT * FROM opinion WHERE id=:id');
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        $date = new DateTime($result['date_publication']);
        if (!$result) {
            return null;
        }
        return new opinion(
            $result['commentary'],
            $date,
            $result['note'],
            $result['id_appointment'],
            $result['id_opinion'],
        );
    }

    public function findAll(): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM opinion');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //UPDATE
    public function update(opinion $opinion): bool
    {
        $stmt = $this->pdo->prepare('UPDATE opinion SET commentary=:commentary, note=:note WHERE id_opinion=:id');
        $result = $stmt->execute([
            'commentary' => $opinion->getCommentary(),
            'note' => $opinion->getNote(),
            'id' => $opinion->getIdOpinion()
        ]);
        return $result;
    }

    //DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM opinion WHERE id_opinion=:id');
        $result = $stmt->execute(['id' => $id]);
        return $result;
    }
}
