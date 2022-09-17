<?php

namespace Arch\Application;

use Arch\Application\Events\EventBusInterface;
use Arch\Application\Response\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CommandBus
 * @package Arch\Application\Middlewares
 */
final class CommandBus
{

    /**
     * The command dispatcher
     *
     * @var \Closure
     */
    private \Closure $middlewareChain;
    /**
     * The logger to log message in log file
     *
     * @var LoggerInterface
     */
    private $logger;
    /**
     * The event bus to dispatch a given event to
     *
     * @var EventBusInterface
     */
    private EventBusInterface $eventBusInterface;

    /**
     *
     * @param MiddlewaresResolver $middlewaresResolver
     * @param LoggerInterface $loggerInterface
     * @param EventBusInterface $eventBusInterface
     */
    public function __construct(
        MiddlewaresResolver $middlewaresResolver,
        LoggerInterface $loggerInterface,
        EventBusInterface $eventBusInterface
    )
    {
        $this->logger = $loggerInterface;
        $this->eventBusInterface = $eventBusInterface;
        $nextCallable = static fn() => null;
        // Setting up middlewares stack with a closure
        $middlewares = call_user_func($middlewaresResolver);
        while ($middleware = array_pop($middlewares)) {
            $nextCallable = static fn(object $command) => call_user_func($middleware, $command, $nextCallable);
        }
        $this->middlewareChain = $nextCallable;
    }

    public function dispatch(object $command): ResponseInterface
    {

        /**@var ResponseInterface $response */
        $response = ($this->middlewareChain)($command);
        if ($response->hasEvent()) {
            $this->eventBusInterface->dispatch($response->events());
        }

        return $response;
    }
}
