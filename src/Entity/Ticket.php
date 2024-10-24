<?php

namespace App\Entity;

use App\Entity\Enum\Priority;
use App\Entity\Enum\Status;
use App\Entity\Utils\BaseEntity;
use App\Repository\TicketRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket extends BaseEntity
{
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    #[ORM\Column(length: 255, nullable: false)]
    private string $title;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255, enumType: Status::class, nullable: false)]
    private Status $status;

    #[ORM\Column(type: "string", length: 255, enumType: Priority::class, nullable: false)]
    private Priority $priority;

    #[ORM\Column(name: 'dead_line', nullable: true)]
    #[Assert\DateTime]
    private ?\DateTime $deadLine;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'assignedTickets')]
    private ?User $assignedTo;

    #[ORM\OneToMany(targetEntity: TicketStatusHistory::class, mappedBy: 'ticket')]
    private Collection $statusHistory;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): Priority
    {
        return $this->priority;
    }

    public function setPriority(string $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getAssignedTo(): ?User
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(?User $assignedTo): self
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    public function getDeadLine(): ?\DateTime
    {
        return $this->deadLine;
    }

    public function setDeadLine(\DateTime $deadLine): static
    {
        $this->deadLine = $deadLine;

        return $this;
    }

    public function getStatusHistory(): Collection
    {
        return $this->statusHistory;
    }

    public function  getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): static
    {
        $this->status = $status;

        return $this;
    }
}
