<?php

namespace Arch\Application\Shared\Response;

use Arch\Application\Events\DomainEvent;

interface ResponseInterface
{
    public function render(): array;

    public function hasEvent(): bool;

    public function events(): DomainEvent;
}
