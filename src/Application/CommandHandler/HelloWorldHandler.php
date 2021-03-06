<?php

namespace Arch\Application\CommandHandler;

use Arch\Application\Command\HelloWorld;
use Arch\Application\Events\Helloworld\MessageSent;
use Arch\Application\Response\ResponseInterface;
use Arch\Application\Response\ViewModel;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldHandler
{

    public function __invoke(HelloWorld $helloWorld): ResponseInterface
    {
        return ViewModel::withEvent([
            'data' => $helloWorld->message(),
            'message' => 'The message to send to the client',
            'status' => Response::HTTP_OK,
        ], new MessageSent(1, 'Thank you to use my package!'));
    }
}
