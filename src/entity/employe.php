<?php

namespace App\entity;


class employe
{
    private ?int $id_employe;
    private string $firstname;

    public function __construct(string $firstname, ?int $id_employe = null)
    {
        $this->firstname = $firstname;
        $this->id_employe = $id_employe;
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

    public function getIdEmploye(): ?int
    {
        return $this->id_employe;
    }

    public function setIdEmploye(?int $id_employe): self
    {
        $this->id_employe = $id_employe;

        return $this;
    }
}
