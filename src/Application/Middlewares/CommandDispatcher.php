<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Command\CommandInterface;
use Arch\Application\Events\EventBusInterface;
use Arch\Application\Response\ResponseInterface;
use Psr\Log\LoggerInterface;

final class CommandDispatcher implements CommandBus
{

    /**
     * The command dispatcher
     *
     * @var CommandHandlerInterface
     */
    private $next;
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
    private $eventBusInterface;
    /**
     *
     * @param LoggerInterface $loggerInterface
     * @param CommandHandlerInterface $next
     */
    public function __construct(
        iterable $middlewares,
        LoggerInterface $loggerInterface,
        EventBusInterface $eventBusInterface,
        CommandHandlerInterface $commandHandlerInterface
    ) {
        $this->logger = $loggerInterface;
        // The next middleware which will be handle the command
        $this->next = $commandHandlerInterface;
        $this->eventBusInterface = $eventBusInterface;

        // Setting up middlewares stack
        foreach ($middlewares as $middleware) {
            $temp = $this->next;
            $this->next = function (CommandInterface $commandInterface) use ($middleware, $temp) {
                return $middleware($commandInterface, $temp);
            };
        }
    }

    public function dispatch(CommandInterface $commandInterface): ResponseInterface
    {
        /** @var ResponseInterface $response */
         $response =  call_user_func($this->next, $commandInterface);

        if ($response->hasEvent()) {
            $this->eventBusInterface->dispatch($response->events());
        }
        
        return $response;
    }
}
