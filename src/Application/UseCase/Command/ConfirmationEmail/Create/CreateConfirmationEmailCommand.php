<?php

namespace App\Application\UseCase\Command\ConfirmationEmail\Create;

class CreateConfirmationEmailCommand
{
    private string $emailAddress;
    private string $firstName;
    private string $lastName;

    public function __construct(string $emailAddress, string $firstName, string $lastName)
    {
        $this->emailAddress = $emailAddress;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}