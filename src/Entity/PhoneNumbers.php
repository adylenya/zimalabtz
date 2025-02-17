<?php

namespace App\Entity;

use App\Repository\PhoneNumbersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PhoneNumbers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(
        max: 20,
        maxMessage: 'Номер телефона не может быть длиннее {{ limit }} символов'
    )]
    private ?string $phone1 = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(
        max: 20,
        maxMessage: 'Номер телефона не может быть длиннее {{ limit }} символов'
    )]
    private ?string $phone2 = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(
        max: 20,
        maxMessage: 'Номер телефона не может быть длиннее {{ limit }} символов'
    )]
    private ?string $phone3 = null;

    #[ORM\OneToOne(inversedBy: 'phoneNumbers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone1(): ?string
    {
        return $this->phone1;
    }

    public function setPhone1(?string $phone1): self
    {
        $this->phone1 = $phone1;
        return $this;
    }

    public function getPhone2(): ?string
    {
        return $this->phone2;
    }

    public function setPhone2(?string $phone2): self
    {
        $this->phone2 = $phone2;
        return $this;
    }

    public function getPhone3(): ?string
    {
        return $this->phone3;
    }

    public function setPhone3(?string $phone3): self
    {
        $this->phone3 = $phone3;
        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }
}