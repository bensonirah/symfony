<?php

namespace Arch\Application\Query\Message;

use Arch\Application\Shared\Response\ResponseInterface;
use Arch\Application\Shared\Response\ViewModel;
use Arch\Domain\Repository\MessageRepositoryInterface;

final class GetMessageQueryHandler
{
    private MessageRepositoryInterface $messageRepository;

    /**
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function __invoke(GetMessage $getMessage): ResponseInterface
    {
        $oMessage = $this->messageRepository->get($getMessage->messageId());
        return ViewModel::withValue(
            ['data' => $oMessage->serialize()]
        );
    }
}