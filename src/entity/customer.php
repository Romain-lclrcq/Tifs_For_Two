<?php

namespace App\entity;

use \Datetime;

class customer
{
    private ?int $Id_customer;
    private string $lastname;
    private string $firstname;
    private DateTime $birthday;
    private int $Id_account;

    public function __construct(
        string $lastname,
        string $firstname,
        DateTime $birthday,
        int $Id_account,
        ?int $Id_customer = null
    ) {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthday = $birthday;
        $this->Id_account = $Id_account;
        $this->Id_customer = $Id_customer;
    }

    public function getIdcustomer(): ?int
    {
        return $this->Id_customer;
    }

    public function setIdcustomer(?int $Id_customer): self
    {
        $this->Id_customer = $Id_customer;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getIdAccount(): int
    {
        return $this->Id_account;
    }

    public function setIdAccount(int $Id_account): self
    {
        $this->Id_account = $Id_account;

        return $this;
    }
}
