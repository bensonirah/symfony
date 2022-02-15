<?php

namespace Arch\Application\Response;

use Arch\Application\Events\DomainEvent;

final class ViewModel implements ResponseInterface
{

    /**
     * The domain event
     *
     * @var DomainEvent
     */
    private $event;
    /**
     * The view to render to the client
     *
     * @var array
     */
    private $view;

    private function __construct(array $data, ?DomainEvent $event)
    {
        $this->view = $data;
        $this->event = $event;
    }
    public static function withValue(array $data): self
    {
        return new self($data, null);
    }

    public static function withEvent(array $data, DomainEvent $domainEvent)
    {
        return new self($data, $domainEvent);
    }

    public function hasEvent(): bool
    {
        return $this->event != null;
    }

    public function events(): DomainEvent
    {
        return $this->event;
    }

    public function render(): array
    {
        return $this->view;
    }
}
