<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\Enum\UserRole;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $first_name = null;

    #[ORM\Column(length: 100)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $registration_date = null;

    #[ORM\Column]
    private ?bool $is_active = true;

    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];
    

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: "user", orphanRemoval: true)]
    private Collection $orders;

    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: "user", orphanRemoval: true)]
    private Collection $carts;

    #[ORM\OneToMany(targetEntity: ActivityLog::class, mappedBy: "user", orphanRemoval: true)]
    private Collection $logs;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->logs = new ArrayCollection();
        $this->registration_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;
        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registration_date;
    }

    public function setRegistrationDate(\DateTimeInterface $registration_date): static
    {
        $this->registration_date = $registration_date;
        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;
        return $this;
    }

    public function getRole(): UserRole
    {
        return $this->role;
    }

    public function setRole(UserRole $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getRoles(): array
{
    $roles = $this->roles;
    $roles[] = 'ROLE_USER'; 
    return array_unique($roles);
}

public function setRoles(array $roles): static
{
    $this->roles = $roles;
    return $this;
}

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function getRoles(): array
    {
        return [$this->role->value];
    }
    

    public function eraseCredentials(): void
    {
        // Symfony requires this method but we don't need to use it
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
