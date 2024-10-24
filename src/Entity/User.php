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
    private Collection $assignedTickets;


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

    public function getRole(): array
    {
        $roles = $this->role;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRole(array $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getAssignedTickets(): Collection
    {
        return $this->assignedTickets;
    }

    public function getRoles(): array
    {
        return [$this->role];
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
