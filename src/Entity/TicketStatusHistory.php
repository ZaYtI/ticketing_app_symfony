<?php

namespace App\Entity;

use App\Entity\Enum\Status;
use App\Entity\Utils\BaseEntity;
use App\Repository\TicketStatusHistoryRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use function Symfony\Component\Clock\now;

#[ORM\Entity(repositoryClass: TicketStatusHistoryRepository::class)]
#[ORM\Table(name: "ticket_status_history")]
class TicketStatusHistory extends BaseEntity
{

    public function __construct()
    {
        $this->changeAt = new \DateTime();
    }

    #[ORM\Column(type: "string", length: 255, enumType: Status::class, nullable: false)]
    private Status $status = Status::OPEN;

    #[ORM\ManyToOne(targetEntity: Ticket::class, inversedBy: 'statusHistory')]
    #[ORM\JoinColumn(name: 'ticket_id')]
    private Ticket $ticket;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "changed_user_id")]
    private User $changedBy;


    #[ORM\Column(name: 'change_at', nullable: false)]
    #[Assert\DateTime]
    private \DateTime $changeAt;

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    public function getChangeAt(): \DateTime
    {
        return $this->changeAt;
    }

    public function getChangedBy(): User
    {
        return $this->changedBy;
    }
}
