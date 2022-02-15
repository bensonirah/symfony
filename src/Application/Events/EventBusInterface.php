<?php

namespace Arch\Application\Events;


interface EventBusInterface
{
    public function dispatch(DomainEvent $domainEvent);
}
