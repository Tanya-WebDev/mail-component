<?php

namespace App\Infrasrtructure\Request\Resolver\Email;

use App\Application\UseCase\Command\FeedbackEmail\Create\CreateFeedbackEmailCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class CreateFeedbackEmailValueResolver implements ValueResolverInterface
{

    /**
     * @inheritDoc
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if(CreateFeedbackEmailCommand::class !== $argument->getType()) {
            return [];
        }

        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $emailAddress = $request->request->get('emailAddress');
        $emailTopic = $request->request->get('emailTopic');
        $emailBody = $request->request->get('emailBody');

        $feedbackCommand = new CreateFeedbackEmailCommand(
            $firstName,
            $lastName,
            $emailAddress,
            $emailTopic,
            $emailBody
        );

        return [$feedbackCommand];
    }
}