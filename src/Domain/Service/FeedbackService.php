<?php

namespace App\Domain\Service;

use App\Domain\Entity\FeedbackEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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

    public function sendConfirmationEmail(string $senderEmailAddress, string $senderFirstName, string $senderLastName): void
    {
        $confirmation = (new TemplatedEmail())
            ->from('assist.upay@gmail.com')
            ->to($senderEmailAddress)
            ->subject('Confirmation of Email Receipt from upay.com')
            ->htmlTemplate('emails/confirmation-email.html.twig')
            ->locale('en')
            ->context([
                'senderFirstName' => $senderFirstName,
                'senderLastName' => $senderLastName,
            ])
        ;

        $this->mailer->send($confirmation);
    }

}