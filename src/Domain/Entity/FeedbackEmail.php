<?php

namespace App\Domain\Entity;

use App\Domain\Repository\FeedbackEmailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeedbackEmailRepository::class)]
class FeedbackEmail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $emailAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $emailTopic = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $emailBody = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sentAt = null;

    #[ORM\Column]
    private ?bool $sendingStatus = false;

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

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): static
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getEmailTopic(): ?string
    {
        return $this->emailTopic;
    }

    public function setEmailTopic(string $emailTopic): static
    {
        $this->emailTopic = $emailTopic;

        return $this;
    }

    public function getEmailBody(): ?string
    {
        return $this->emailBody;
    }

    public function setEmailBody(string $emailBody): static
    {
        $this->emailBody = $emailBody;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): static
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function isSendingStatus(): ?bool
    {
        return $this->sendingStatus;
    }

    public function setSendingStatus(bool $sendingStatus): static
    {
        $this->sendingStatus = $sendingStatus;

        return $this;
    }
}
