<?php

namespace App\UI\Http\Web;

use App\Domain\Factory\FeedbackEmailFactory;
use App\Domain\Repository\FeedbackEmailRepository;
use App\Domain\Service\FeedbackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackEmailController extends AbstractController
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

    #[Route('/feedback', name: 'feedback_email', methods: ['POST'])]
    public function sendFeedbackEmail(Request $request): Response
    {
        $feedbackEmail = $this->feedbackEmailFactory->createFromPostRequest($request);

        $this->feedbackEmailRepository->save($feedbackEmail);

        $isSent = $this->feedbackService->sendFeedbackEmail($feedbackEmail);

        if ($isSent) {
            $feedbackEmail->setSendingStatus(true);
            $this->feedbackEmailRepository->save($feedbackEmail);

            $this->feedbackService->sendConfirmationEmail($feedbackEmail);

            return new Response('Your email has been sent successfully!');
        } else {
            return new Response('Email sending failed!');
        }
    }
}