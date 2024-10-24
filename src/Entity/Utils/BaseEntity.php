<?php

namespace App\Entity\Utils;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

abstract class BaseEntity
{

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(name: 'created_at', nullable: false)]
    #[Assert\DateTime]
    protected \DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', nullable: false)]
    #[Assert\DateTime]
    protected \DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
