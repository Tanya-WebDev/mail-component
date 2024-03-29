<?php

namespace App\UI\Http\Web;

use App\Application\UseCase\Command\ConfirmationEmail\Create\CreateConfirmationEmailCommand;
use App\Application\UseCase\Command\FeedbackEmail\Create\CreateFeedbackEmailCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FeedbackEmailController extends AbstractController
{
    #[Route('/feedback', name: 'feedback_email', methods: ['POST'])]
    public function sendFeedbackEmail(MessageBusInterface $commandBus, ValidatorInterface $validator, CreateFeedbackEmailCommand $feedbackCommand, CreateConfirmationEmailCommand $confirmationCommand): Response
    {
        $violations = $validator->validate($feedbackCommand);

        if ($violations->count() > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }

            return new Response(implode(', ', $errors));
        } else {
            try {
                $commandBus->dispatch($feedbackCommand);
                $commandBus->dispatch($confirmationCommand);

                return new Response('Your email has been sent successfully!');
            } catch (HandlerFailedException $exception) {
                return new Response('Email sending failed!');
            }
        }

    }
}