<?php

namespace App\Entity;

use App\Enum\PaymentStatus;
use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Order;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $payment_date = null;

    #[ORM\Column(length: 50)]
    private ?string $payment_method = null;

    #[ORM\Column(length: 100)]
    private ?string $transaction_reference = null;

    #[ORM\Column(type: "string", enumType: PaymentStatus::class)]
    private PaymentStatus $payment_status;

    #[ORM\OneToOne(targetEntity: Order::class, inversedBy: "payment")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;
        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->payment_date;
    }

    public function setPaymentDate(\DateTimeInterface $payment_date): static
    {
        $this->payment_date = $payment_date;
        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): static
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    public function getTransactionReference(): ?string
    {
        return $this->transaction_reference;
    }

    public function setTransactionReference(string $transaction_reference): static
    {
        $this->transaction_reference = $transaction_reference;
        return $this;
    }

    public function getPaymentStatus(): PaymentStatus
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(PaymentStatus $payment_status): static
    {
        $this->payment_status = $payment_status;
        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): static
    {
        $this->order = $order;
        return $this;
    }
}
