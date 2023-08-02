<?php

namespace Arch\Domain\Exception;

abstract class DomainEntityException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    abstract public static function fromMessage(string $message): DomainEntityException;

    abstract public static function fromId(int $id): self;
}