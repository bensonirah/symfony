<?php

namespace Arch\Domain\Exception;

trait DomainEntityExceptionTrait
{
    public static function fromMessage(string $message): DomainEntityException
    {
        return new self($message);
    }

    public static function fromId(int $id): DomainEntityException
    {
        return new self(sprintf("Unable to find entity with ID %s", $id));
    }
}