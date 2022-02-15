<?php

namespace Arch\Application\Events\Handler;

use Arch\Application\Events\Helloworld\MessageSent;
use Psr\Log\LoggerInterface;

final class SendEmailOnMessageSent
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(MessageSent $messageSent)
    {
        $this->logger->debug(sprintf('Message to be sent:  %s by %s', $messageSent->message(), __CLASS__));
    }
}
