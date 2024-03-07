<?php

namespace App\Infrasrtructure\Request\Resolver\Email;

use App\Application\UseCase\Command\ConfirmationEmail\Create\CreateConfirmationEmailCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class CreateConfirmationEmailValueResolver implements ValueResolverInterface
{

    /**
     * @inheritDoc
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if(CreateConfirmationEmailCommand::class !== $argument->getType()) {
            return [];
        }

        $emailAddress = $request->request->get('emailAddress');
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');


        $confirmationCommand = new CreateConfirmationEmailCommand(
            $emailAddress,
            $firstName,
            $lastName
        );

        return [$confirmationCommand];
    }
}