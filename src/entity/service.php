<?php

namespace App\entity;

class service
{
    private ?int $id_service;
    private string $description;
    private string $price;
    private string $time;

    public function __construct(string $description, string $price, string $time, ?int $id_service = null)
    {
        $this->description = $description;
        $this->price = $price;
        $this->time = $time;
        $this->id_service = $id_service;
    }


    public function getIdService(): ?int
    {
        return $this->id_service;
    }

    public function setIdService(?int $id_service): self
    {
        $this->id_service = $id_service;

        return $this;
    }


    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
