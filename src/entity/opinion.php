<?php

namespace App\entity;

use \DateTime;

class opinion
{
    private ?int $id_opinion;
    private string $commentary;
    private DateTime $date_publication;
    private int $note;
    private int $id_appointment;

    public function __construct(
        string $commentary,
        DateTime $date_publication,
        int $note,
        int $id_appointment,
        ?int $id_opinion = null
    ) {
        $this->commentary = $commentary;
        $this->date_publication = $date_publication;
        $this->note = $note;
        $this->id_appointment = $id_appointment;
        $this->id_opinion = $id_opinion;
    }

    public function getIdOpinion(): ?int
    {
        return $this->id_opinion;
    }

    public function setIdOpinion(?int $id_opinion): self
    {
        $this->id_opinion = $id_opinion;

        return $this;
    }

    public function getCommentary(): string
    {
        return $this->commentary;
    }

    public function setCommentary(string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getDatePublication(): DateTime
    {
        return $this->date_publication;
    }

    public function setDatePublication(DateTime $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdAppointment(): int
    {
        return $this->id_appointment;
    }

    public function setIdAppointment(int $id_appointment): self
    {
        $this->id_appointment = $id_appointment;

        return $this;
    }
}
