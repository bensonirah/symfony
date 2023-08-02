<?php

namespace Arch\Application\Command\Message;

final class SendMessage
{
    /**
     * The message content
     */
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function message(): string
    {
        return $this->message;
    }
}
