<?php

namespace App\Entity;

use App\Entity\Utils\BaseEntity;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project extends BaseEntity
{

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    #[ORM\Column(name: "name", length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(name: "deadline", nullable: true)]
    private ?\DateTime $deadline;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'projects')]
    #[ORM\JoinTable(name: 'project_member')]
    private Collection $users;

    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'project')]
    private Collection $tickets;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }

    public function setDeadLine(\DateTime $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function getTickets(): Collection
    {
        return $this->tickets;
    }
}
