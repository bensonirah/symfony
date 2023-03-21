<?php

namespace Arch\Domain\Exception;

use Exception;

final class MessageNotFoundException extends DomainEntityException
{
    public static function fromId(int $id): self
    {
        return new self(sprintf("Unable to find message with id: %d", $id));
    }
}
