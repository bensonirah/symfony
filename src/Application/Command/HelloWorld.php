<?php

namespace Arch\Application\Command;

final class HelloWorld
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
