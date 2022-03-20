<?php

namespace App\Entity;

use App\Repository\StayRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StayRepository::class)
 */
class Stay
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="date")
     */
    private $startdateav;

    /**
     * @ORM\Column(type="date")
     */
    private $enddateav;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="stays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getStartdateav(): ?\DateTimeInterface
    {
        return $this->startdateav;
    }

    public function setStartdateav(\DateTimeInterface $startdateav): self
    {
        $this->startdateav = $startdateav;

        return $this;
    }

    public function getEnddateav(): ?\DateTimeInterface
    {
        return $this->enddateav;
    }

    public function setEnddateav(\DateTimeInterface $enddateav): self
    {
        $this->enddateav = $enddateav;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}
