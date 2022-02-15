<?php

namespace Arch\Application\Events\Helloworld;

use Arch\Application\Events\DomainEvent;

final class MessageSent implements DomainEvent
{
    /**
     *  The user id to send email to
     *
     * @var int
     */
    private $userToNotify;

    /**
     * The message to send through email
     *
     * @var string
     */
    private $message;

    public function __construct(int $userToNotify, string $helloworldMessage)
    {
        $this->userToNotify = $userToNotify;
        $this->message = $helloworldMessage;
    }

    public function userToNotify(): int
    {
        return $this->userToNotify;
    }

    public function message(): string
    {
        return $this->message;
    }
}
