<?php

namespace Arch\Application\Events\Message;

use Psr\Log\LoggerInterface;

final class SendEmailOnMessageSent
{
    private LoggerInterface $logger;

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
