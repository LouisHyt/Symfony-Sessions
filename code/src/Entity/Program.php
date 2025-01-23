<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $totalDays = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalDays(): ?int
    {
        return $this->totalDays;
    }

    public function setTotalDays(int $totalDays): static
    {
        $this->totalDays = $totalDays;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }
}
