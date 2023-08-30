<?php

namespace App\Domain\Factory;

use App\Domain\Entity\FeedbackEmail;
use Symfony\Component\HttpFoundation\Request;

class FeedbackEmailFactory
{
    public static function createFromPostRequest(Request $request): FeedbackEmail
    {
        $feedbackEmail = new FeedbackEmail();

        $feedbackEmail->setFirstName($request->get('firstName'));
        $feedbackEmail->setLastName($request->get('lastName'));
        $feedbackEmail->setEmailAddress($request->get('emailAddress'));
        $feedbackEmail->setEmailTopic($request->get('emailTopic'));
        $feedbackEmail->setEmailBody($request->get('emailBody'));
        $feedbackEmail->setSentAt(new \DateTime());

        return $feedbackEmail;
    }
}