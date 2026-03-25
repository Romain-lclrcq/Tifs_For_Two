<?php

namespace App\entity;

use \DateTime;

class appointment
{
    private ?int $Id_appointment;
    private DateTime $Date_time;
    private int $Id_employe;
    private int $Id_customer;
    private int $Id_service;

    public function __construct(DateTime $Date_time, int $Id_employe, int $Id_customer, int $Id_service, ?int $Id_appointment = null)
    {
        $this->Date_time = $Date_time;
        $this->Id_employe = $Id_employe;
        $this->Id_customer = $Id_customer;
        $this->Id_service = $Id_service;
        $this->Id_appointment = $Id_appointment;
    }

    public function getIdAppointment(): ?int
    {
        return $this->Id_appointment;
    }

    public function setIdAppointment(?int $Id_appointment): self
    {
        $this->Id_appointment = $Id_appointment;

        return $this;
    }

    public function getIdEmploye(): int
    {
        return $this->Id_employe;
    }

    public function setIdEmploye(int $Id_Employe): self
    {
        $this->Id_employe = $Id_Employe;

        return $this;
    }

    public function getIdCustomer(): int
    {
        return $this->Id_customer;
    }

    public function setIdCustomer(int $Id_Customer): self
    {
        $this->Id_customer = $Id_Customer;

        return $this;
    }

    public function getDateTime(): DateTime
    {
        return $this->Date_time;
    }

    public function setDateTime(DateTime $Date_time): self
    {
        $this->Date_time = $Date_time;

        return $this;
    }

    public function getIdService(): int
    {
        return $this->Id_service;
    }

    public function setIdService(int $Id_Service): self
    {
        $this->Id_service = $Id_Service;

        return $this;
    }
}
