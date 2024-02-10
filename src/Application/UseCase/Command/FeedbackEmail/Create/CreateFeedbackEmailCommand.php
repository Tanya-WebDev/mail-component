<?php

namespace App\Application\UseCase\Command\FeedbackEmail\Create;

use Symfony\Component\Validator\Constraints as Assert;

class CreateFeedbackEmailCommand
{

    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Regex("/^[\p{L}\p{N}\p{P}\s]+$/u")]
    private string $firstName;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Regex("/^[\p{L}\p{N}\p{P}\s]+$/u")]
    private string $lastName;

    #[Assert\NotBlank()]
    #[Assert\Email]
    private string $emailAddress;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Regex("/^[\p{L}\p{N}\p{P}\s]+$/u")]
    private string $emailTopic;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 20, max: 2000)]
    #[Assert\Regex("/^[\p{L}\p{N}\p{P}\s\n]+$/u")]
    private string $emailBody;

    public function __construct(
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $emailTopic,
        string $emailBody
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emailAddress = $emailAddress;
        $this->emailTopic = $emailTopic;
        $this->emailBody = $emailBody;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getEmailTopic(): string
    {
        return $this->emailTopic;
    }

    public function getEmailBody(): string
    {
        return $this->emailBody;
    }
}