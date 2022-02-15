<?php

namespace Arch\Application\Response;

use Arch\Application\Events\DomainEvent;

interface ResponseInterface
{
    public function render(): array;

    public function hasEvent(): bool;

    public function events(): DomainEvent;
}
