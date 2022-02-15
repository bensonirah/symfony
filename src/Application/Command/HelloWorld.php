<?php

namespace Arch\Application\Command;

final class HelloWorld implements CommandInterface
{
    /**
     * The message content
     *
     * @var string
     */
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function connectedUser(): int
    {
        return 0;
    }
}
