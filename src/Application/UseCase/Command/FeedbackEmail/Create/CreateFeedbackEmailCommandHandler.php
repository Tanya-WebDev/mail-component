<?php

namespace App\Application\UseCase\Command\FeedbackEmail\Create;

use App\Domain\Factory\FeedbackEmailFactory;
use App\Domain\Repository\FeedbackEmailRepository;
use App\Domain\Service\FeedbackService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateFeedbackEmailCommandHandler
{
    private FeedbackEmailFactory $feedbackEmailFactory;
    private FeedbackEmailRepository $feedbackEmailRepository;
    private FeedbackService $feedbackService;

    public function __construct(
        FeedbackEmailFactory $feedbackEmailFactory,
        FeedbackEmailRepository $feedbackEmailRepository,
        FeedbackService $feedbackService
    ) {
        $this->feedbackEmailFactory = $feedbackEmailFactory;
        $this->feedbackEmailRepository = $feedbackEmailRepository;
        $this->feedbackService = $feedbackService;
    }

    public function __invoke(CreateFeedbackEmailCommand $command): void
    {
        $feedbackEmail = $this->feedbackEmailFactory->createFromCommand($command);

        $this->feedbackEmailRepository->save($feedbackEmail);

        $isSent = $this->feedbackService->sendFeedbackEmail($feedbackEmail);

        if ($isSent) {
            $feedbackEmail->setSendingStatus(true);
            $this->feedbackEmailRepository->save($feedbackEmail);
        }
    }
}