<?php

namespace Arch\Domain\Exception;

final class EntityNotFoundException extends DomainEntityException
{
    use DomainEntityExceptionTrait;
}