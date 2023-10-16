<?php

namespace App\Domain\Factory;

use App\Application\UseCase\Command\FeedbackEmail\Create\CreateFeedbackEmailCommand;
use App\Domain\Entity\FeedbackEmail;

class FeedbackEmailFactory
{
    public static function createFromCommand(CreateFeedbackEmailCommand $command): FeedbackEmail
    {
        $feedbackEmail = new FeedbackEmail();

        $feedbackEmail->setFirstName($command->getFirstName());
        $feedbackEmail->setLastName($command->getLastName());
        $feedbackEmail->setEmailAddress($command->getEmailAddress());
        $feedbackEmail->setEmailTopic($command->getEmailTopic());
        $feedbackEmail->setEmailBody($command->getEmailBody());
        $feedbackEmail->setSentAt(new \DateTime());

        return $feedbackEmail;
    }
}