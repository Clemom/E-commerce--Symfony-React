<?php

namespace App\Entity;

use App\Repository\ActivityLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\ActionType;

#[ORM\Entity(repositoryClass: ActivityLogRepository::class)]
class ActivityLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $action_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $details = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $ip_address = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $user_agent = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "activityLogs")]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: ActionType::class, inversedBy: "logs")]
    #[ORM\JoinColumn(nullable: false)]
    private ?ActionType $actionType = null;

    public function __construct()
    {
        $this->action_date = new \DateTime(); // Initialise la date de l'action
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActionDate(): ?\DateTimeInterface
    {
        return $this->action_date;
    }

    public function setActionDate(\DateTimeInterface $action_date): static
    {
        $this->action_date = $action_date;
        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): static
    {
        $this->details = $details;
        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(?string $ip_address): static
    {
        $this->ip_address = $ip_address;
        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->user_agent;
    }

    public function setUserAgent(?string $user_agent): static
    {
        $this->user_agent = $user_agent;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getActionType(): ?ActionType
    {
        return $this->actionType;
    }

    public function setActionType(?ActionType $actionType): static
    {
        $this->actionType = $actionType;
        return $this;
    }
}
