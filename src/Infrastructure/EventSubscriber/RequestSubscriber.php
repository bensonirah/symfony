<?php

namespace Arch\Infrastructure\EventSubscriber;

use Arch\Infrastructure\Middlewares\Http\HttpMiddlewareResolver;
use Arch\Infrastructure\Middlewares\Http\IResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestSubscriber implements EventSubscriberInterface
{
    private \Closure $nextMiddleware;
    private LoggerInterface $logger;

    /**
     * @param HttpMiddlewareResolver $httpMiddlewareResolver
     * @param LoggerInterface $logger
     */
    public function __construct(HttpMiddlewareResolver $httpMiddlewareResolver, LoggerInterface $logger)
    {
        $nextCallable = static fn() => null;
        // Setting up middlewares stack with a closure
        $middlewares = call_user_func($httpMiddlewareResolver);
        while ($middleware = array_pop($middlewares)) {
            $nextCallable = static fn(object $command) => call_user_func($middleware, $command, $nextCallable);
        }
        $this->nextMiddleware = $nextCallable;
        $this->logger = $logger;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Run only this middleware when route exist
        if ($event->getRequest()->attributes->has('_route')) {
            /**@var IResponse $response */
            $response = ($this->nextMiddleware)($event->getRequest());
            $this->logger->debug(
                sprintf(
                    "source: %s line: %s",
                     __CLASS__, __LINE__
                )
            );
            if ($response->hasResponse()) {
//          Return a response back to the client
                $event->setResponse($response->get());
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
