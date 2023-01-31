<?php

namespace Arch\Application\Handler;

use Arch\Application\Command\HelloWorld;
use Arch\Application\Events\Helloworld\MessageSent;
use Arch\Application\Response\ResponseInterface;
use Arch\Application\Response\ViewModel;
use Arch\Domain\Entity\Message;
use Arch\Domain\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HelloWorldHandler The command handler for HelloWorld command
 * @package Arch\Application\Handler
 */
final class HelloWorldHandler
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository;
    }
    public function __invoke(HelloWorld $helloWorld): ResponseInterface
    {
        $this->messageRepository->add(Message::fromInput($helloWorld));
        return ViewModel::withEvent([
            'data' => $helloWorld->message(),
            'message' => 'The message to send to the client',
            'status' => Response::HTTP_OK,
        ], new MessageSent(1, 'Thank you to use my package!'));
    }
}
