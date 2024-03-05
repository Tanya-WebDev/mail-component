<?php

namespace App\Application\UseCase\Command\ConfirmationEmail\Create;

use App\Domain\Service\FeedbackService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateConfirmationEmailCommandHandler
{
    private FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function __invoke(CreateConfirmationEmailCommand $command): void
    {
        $this->feedbackService->sendConfirmationEmail($command->getEmailAddress(), $command->getFirstName(), $command->getLastName());
    }
}