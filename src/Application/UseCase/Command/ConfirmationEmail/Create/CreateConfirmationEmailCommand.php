<?php

namespace App\Application\UseCase\Command\ConfirmationEmail\Create;

class CreateConfirmationEmailCommand
{
    private string $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}