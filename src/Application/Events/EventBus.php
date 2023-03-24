<?php

namespace Arch\Application\Events;


final class EventBus implements EventBusInterface
{
    /**
     * The event handlers
     */
    private array $eventHandlers;

    public function __construct(iterable $eventHandlers)
    {
        foreach ($eventHandlers as $eventHandler) {
            $this->eventHandlers[$this->eventFrom($eventHandler)] = $eventHandler;
        }
    }

    public function dispatch(DomainEvent $domainEvent)
    {
        $eventHandlers = array_filter($this->eventHandlers, function ($key) use ($domainEvent) {
            return get_class($domainEvent) === $key;
        }, ARRAY_FILTER_USE_KEY);
        foreach ($eventHandlers as $eventHandler) {
            $eventHandler($domainEvent);
        }
    }

    private function eventFrom(object $handler): string
    {
        $reflectionMethod = new \ReflectionMethod(get_class($handler), '__invoke');
        $parameters = $reflectionMethod->getParameters();
        return $parameters[0]->getClass()->getName();
    }
}
