<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer entity
 * Сущность клиента в системе
 */
#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Этот email уже используется')]
class Customer
{
    /**
     * Primary key
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Customer's first name
     * Required
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Имя обязательно для заполнения')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Имя должно содержать минимум {{ limit }} символа',
        maxMessage: 'Имя не может быть длиннее {{ limit }} символов'
    )]
    private ?string $firstName = null;

    /**
     * Customer's last name
     * Required
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Фамилия обязательна для заполнения')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Фамилия должна содержать минимум {{ limit }} символа',
        maxMessage: 'Фамилия не может быть длиннее {{ limit }} символов'
    )]
    private ?string $lastName = null;

    /**
     * Customer's email
     * Required and unique
     */
    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: 'Email обязателен для заполнения')]
    #[Assert\Email(message: 'Email {{ value }} некорректен')]
    private ?string $email = null;

    /**
     * Customer's company name
     * Optional
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $companyName = null;

    /**
     * Customer's position in company
     * Optional
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $position = null;

    /**
     * Customer's primary phone number
     * Optional
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 20,
        maxMessage: 'Номер телефона не может быть длиннее {{ limit }} символов'
    )]
    private ?string $phone1 = null;

    /**
     * Customer's secondary phone number
     * Optional
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 20,
        maxMessage: 'Номер телефона не может быть длиннее {{ limit }} символов'
    )]
    private ?string $phone2 = null;

    /**
     * Customer's ???? phone number (честно говоря я не понял что подразумевалось под 3 полями для номера телефона поэтому просто создал 3 поля (: )
     * Optional
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 20,
        maxMessage: 'Номер телефона не может быть длиннее {{ limit }} символов'
    )]
    private ?string $phone3 = null;

    /**
     * Created at timestamp
     */
    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // Геттеры и сеттеры

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;
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

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): static
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): static
    {
        $this->position = $position;
        return $this;
    }

    public function getPhone1(): ?string
    {
        return $this->phone1;
    }

    public function setPhone1(?string $phone1): static
    {
        $this->phone1 = $phone1;
        return $this;
    }

    public function getPhone2(): ?string
    {
        return $this->phone2;
    }

    public function setPhone2(?string $phone2): static
    {
        $this->phone2 = $phone2;
        return $this;
    }

    public function getPhone3(): ?string
    {
        return $this->phone3;
    }

    public function setPhone3(?string $phone3): static
    {
        $this->phone3 = $phone3;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Возвращает полное имя клиента
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}