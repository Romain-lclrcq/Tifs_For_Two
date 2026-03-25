<?php

namespace App\repository;

use \PDO;
use \DateTime;
use App\entity\appointment;

class appointmentRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //CREATE
    public function create(appointment $appointment): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO appointment (Date_time, Id_employe, Id_service, Id_customer) VALUES (:datetime, :idEmploye, :idService, :idCustomer)");
        $result = $stmt->execute([
            'idEmploye' => $appointment->getIdEmploye(),
            'idService' => $appointment->getIdService(),
            'idCustomer' => $appointment->getIdCustomer(),
            'datetime' => $appointment->getDateTime()
        ]);
        return $result;
    }

    //READ
    public function findAppointmentById(int $id): ?appointment
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointment WHERE Id_appointment=:id");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        };
        $birthday = new DateTime($result['Date_time']);
        $appointment = new appointment(
            $birthday,
            $result['Id_employe'],
            $result['Id_customer'],
            $result['Id_service'],
            $result['Id_appointment'],
        );
        return $appointment;
    }

    public function searchAppointmentByDate(int $id): ?appointment
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointment WHERE Date_time=:id");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        };
        $appointment = new appointment(
            $result['Date_time'],
            $result['Id_employe'],
            $result['Id_customer'],
            $result['Id_service'],
            $result['Id_appointment'],
        );
        return $appointment;
    }

    public function findAppointmentByCustomer(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointment WHERE Id_customer=:id ORDER BY Date_time ASC");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetchAll();
        if (!$result) {
            return [];
        }

        $appointments = [];
        foreach ($result as $row) {
            $appointments[] = new appointment(
                new DateTime($row['Date_time']),
                (int)$row['Id_employe'],
                (int)$row['Id_customer'],
                (int)$row['Id_service'],
                (int)$row['Id_appointment']
            );
        }
        return $appointments;
    }

    public function searchAppointmentByService(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointment WHERE Id_service=:id");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetchAll();
        if (!$result) {
            return null;
        };
        $appointment = [];
        foreach ($result as $row) {
            $appointment[] = new appointment(
                $row['Id_customer'],
                $row['Id_service'],
                $row['Id_employe'],
                $row['Id_appointment'],
                $row['Date_time']
            );
        }
        return $appointment;
    }


    public function searchAppointmentByEmploye(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointment WHERE Id_employe=:id");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetchAll();
        if (!$result) {
            return null;
        };
        $appointment = [];
        foreach ($result as $row) {
            $appointment[] = new appointment(
                $row['Id_customer'],
                $row['Id_service'],
                $row['Id_employe'],
                $row['Id_appointment'],
                $row['Date_time']
            );
        }
        return $appointment;
    }


    //UPDATE
    public function update(appointment $appointment): bool
    {
        $stmt = $this->pdo->prepare('UPDATE appointment SET Id_customer=:idCustomer, Id_service=:idService, Id_employe=:idService, DateTime=:date WHERE Id_appointment=:id');
        $result = $stmt->execute([
            "id" => $appointment->getIdAppointment(),
            "idCustomer" => $appointment->getIdCustomer(),
            "idService" => $appointment->getIdService(),
            "idEmploye" => $appointment->getIdEmploye(),
            "date" => $appointment->getDateTime()
        ]);
        return $result;
    }

    //DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM appointment WHERE Id_appointment=:id");
        $result = $stmt->execute(["id" => $id]);
        return $result;
    }
}
