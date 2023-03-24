<?php

namespace Arch\Domain\Entity;

use Arch\Application\Command\HelloWorld;

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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body
        ];
    }
    public function __toString()
    {
        return "uuid: {$this->id}, body: {$this->body}";
    }

    public static function fromInput(HelloWorld $helloWorld): Message
    {
        return new self($helloWorld->message());
    }
}
