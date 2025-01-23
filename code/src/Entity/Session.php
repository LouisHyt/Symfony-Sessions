<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $places = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $beginDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    /**
     * @var Collection<int, Intern>
     */
    #[ORM\ManyToMany(targetEntity: Intern::class, mappedBy: 'sessions')]
    private Collection $interns;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Trainer $trainer = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Training $training = null;

    /**
     * @var Collection<int, Program>
     */
    #[ORM\OneToMany(targetEntity: Program::class, mappedBy: 'session', orphanRemoval: true)]
    private Collection $programs;

    public function __construct()
    {
        $this->interns = new ArrayCollection();
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): static
    {
        $this->places = $places;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }

    public function setBeginDate(\DateTimeInterface $beginDate): static
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, Intern>
     */
    public function getInterns(): Collection
    {
        return $this->interns;
    }

    public function addIntern(Intern $intern): static
    {
        if (!$this->interns->contains($intern)) {
            $this->interns->add($intern);
            $intern->addSession($this);
        }

        return $this;
    }

    public function removeIntern(Intern $intern): static
    {
        if ($this->interns->removeElement($intern)) {
            $intern->removeSession($this);
        }

        return $this;
    }

    public function getTrainer(): ?Trainer
    {
        return $this->trainer;
    }

    public function setTrainer(?Trainer $trainer): static
    {
        $this->trainer = $trainer;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): static
    {
        $this->training = $training;

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): static
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->setSession($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): static
    {
        if ($this->programs->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getSession() === $this) {
                $program->setSession(null);
            }
        }

        return $this;
    }
}
