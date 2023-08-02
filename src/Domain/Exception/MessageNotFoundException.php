<?php

namespace Arch\Domain\Exception;

use Exception;

final class MessageNotFoundException extends DomainEntityException
{
    use DomainEntityExceptionTrait;
}
