<?php

namespace App\Entity;

use App\Repository\InternRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InternRepository::class)]
class Intern
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(length: 5)]
    private ?string $genre = null;

    #[ORM\Column(length: 200)]
    private ?string $city = null;

    #[ORM\Column(length: 25)]
    private ?string $phone = null;

    /**
     * @var Collection<int, Session>
     */
    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'interns')]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }
    
    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $this->phone);
        if (strlen($phoneNumber) === 10) {
            return chunk_split($phoneNumber, 2, ' ');
        }
        return $phoneNumber;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        $this->sessions->removeElement($session);

        return $this;
    }


    //Custom Methods
    public function getFullName(): ?string
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function getAge(): ?int
    {
        return $this->birthDate->diff(new \DateTime())->y;
    }

    public function getSessionStatus(): ?array
    {

        $sessions = $this->sessions;
        $currentDate = new \DateTime();
        $sessionStatus = [
            'label' => 'Inactive',
            'class' => 'inactive'
        ];

        foreach ($sessions as $session) {
            if ($session->getBeginDate() <= $currentDate && $session->getEndDate() >= $currentDate) {
                $sessionStatus = [
                    'label' => 'In Session',
                    'class' => 'in-session'
                ];
                break;
            } elseif ($session->getBeginDate() > $currentDate) {
                $sessionStatus = [
                    'label' => 'Waiting for session',
                    'class' => 'waiting'
                ];
                break;
            }
        }

        return $sessionStatus;
    }
}
