<?php

namespace Arch\Application\Command\Message;

use Arch\Application\Events\Message\MessageSent;
use Arch\Application\Shared\Response\ResponseInterface;
use Arch\Application\Shared\Response\ViewModel;
use Arch\Domain\Entity\Message;
use Arch\Domain\Repository\MessageRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SendMessageHandler The command handler for SendMessage command
 * @package Arch\Application\Handler
 */
final class SendMessageHandler
{
    private MessageRepositoryInterface $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function __invoke(SendMessage $helloWorld): ResponseInterface
    {
        $this->messageRepository->add(Message::fromInput($helloWorld));

        return ViewModel::withEvent(
            [
                'data' => $helloWorld->message(),
                'message' => 'The message to send to the client',
                'status' => Response::HTTP_OK,
            ],
            new MessageSent(1, 'Thank you to use my package!')
        );
    }
}
