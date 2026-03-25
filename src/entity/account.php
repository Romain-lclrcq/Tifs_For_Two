<?php

namespace App\entity;

class account
{
    private ?int $Id_account;
    private string $mail;
    private string $password;
    private string $tel_number;

    public function __construct(string $mail, string $password, string $tel_number, ?int $Id_account = null)
    {
        $this->Id_account = $Id_account;
        $this->mail = $mail;
        $this->password = $password;
        $this->tel_number = $tel_number;
    }

    public function getIdAccount(): ?int
    {
        return $this->Id_account;
    }

    public function setIdAccount(?int $Id_account): self
    {
        $this->Id_account = $Id_account;

        return $this;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTelNumber(): string
    {
        return $this->tel_number;
    }

    public function setTelNumber(string $tel_number): self
    {
        $this->tel_number = $tel_number;

        return $this;
    }
}
