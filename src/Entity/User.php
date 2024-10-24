<?php

namespace App\Entity;

use App\Entity\Enum\Roles;
use App\Entity\Utils\BaseEntity;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('email')]
class User extends BaseEntity implements UserInterface, \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->assignedTickets = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    #[Assert\Email(
        mode: Email::VALIDATION_MODE_STRICT
    )]
    private string $email;

    #[ORM\Column(length: 255, nullable: false)]
    private string $password;

    #[ORM\Column()]
    private ?array $role = [];

    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'assignedTo')]
    private Collection $tickets;

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'users')]
    private Collection $projects;


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function getRoles(): array
    {
        $roles = $this->role;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
}
