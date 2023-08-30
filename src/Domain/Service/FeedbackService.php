<?php

namespace App\Domain\Service;

use App\Domain\Entity\FeedbackEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FeedbackService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendFeedbackEmail(FeedbackEmail $feedbackEmail): bool
    {
        $email = (new Email())
            ->from('assist.upay@gmail.com')
            ->to('assist.upay@gmail.com')
            ->replyTo($feedbackEmail->getEmailAddress())
            ->subject($feedbackEmail->getEmailTopic())
            ->html(
                $feedbackEmail->getEmailBody().
                '<br>Sender: '.
                $feedbackEmail->getFirstName().
                ' '.
                $feedbackEmail->getLastName()
            );

        try {
            $this->mailer->send($email);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function sendConfirmationEmail(FeedbackEmail $feedbackEmail): void
    {
        $confirmation = (new Email())
            ->from('assist.upay@gmail.com')
            ->to($feedbackEmail->getEmailAddress())
            ->subject('Confirmation of Email Receipt from upay.com')
            ->text('Our support team is already solving your problem!');

        $this->mailer->send($confirmation);
    }

}