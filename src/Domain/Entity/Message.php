<?php

namespace Arch\Domain\Entity;

use Arch\Application\Command\Message\SendMessage;

final class Message extends BaseEntity
{
    private string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body
        ];
    }
    public function __toString():string
    {
        return "uuid: {$this->id}, body: {$this->body}";
    }

    public static function fromInput(SendMessage $helloWorld): Message
    {
        return new self($helloWorld->message());
    }
}
