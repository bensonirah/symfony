<?php

namespace Arch\Infrastructure\EventSubscriber;

use Arch\Infrastructure\Middlewares\ExceptionMiddlewareResolver;
use Closure;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private Closure $nextMiddleware;
    private LoggerInterface $logger;

    /**
     * @param ExceptionMiddlewareResolver $exceptionMiddlewareResolver
     * @param LoggerInterface $logger
     */
    public function __construct(ExceptionMiddlewareResolver $exceptionMiddlewareResolver, LoggerInterface $logger)
    {
        $nextCallable = static fn() => null;
        // Setting up middlewares stack with a closure
        $middlewares = call_user_func($exceptionMiddlewareResolver);
        while ($middleware = array_pop($middlewares)) {
            $nextCallable = static fn(object $event) => call_user_func($middleware, $event, $nextCallable);
        }
        $this->nextMiddleware = $nextCallable;
        $this->logger = $logger;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        if ($event->getRequest()->getRequestUri() != '/') {
            $response = ($this->nextMiddleware)($event);
            $this->logger->debug(sprintf("The state of exception middleware: %s", $response));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
}
