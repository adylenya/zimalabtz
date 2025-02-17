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
     * Customer's gender
     */
    #[ORM\Column(length: 10)]
    #[Assert\NotBlank(message: 'Пол обязателен для заполнения')]
    #[Assert\Choice(choices: ['male', 'female'], message: 'Выберите корректное значение пола')]
    private ?string $gender = null;

    /**
     * Customer's phone number (теперь как отдельная сущность)
     */
    #[ORM\OneToOne(mappedBy: 'customer', cascade: ['persist', 'remove'])]
    private ?PhoneNumbers $phoneNumbers = null;

    /**
     * Created at timestamp
     */
    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->phoneNumbers = new PhoneNumbers();
        $this->phoneNumbers->setCustomer($this);
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPhoneNumbers(): ?PhoneNumbers
    {
        return $this->phoneNumbers;
    }

    public function setPhoneNumbers(PhoneNumbers $phoneNumbers): self
    {
        if ($phoneNumbers->getCustomer() !== $this) {
            $phoneNumbers->setCustomer($this);
        }

        $this->phoneNumbers = $phoneNumbers;
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