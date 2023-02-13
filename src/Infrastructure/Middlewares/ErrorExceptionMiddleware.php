<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ErrorExceptionMiddleware implements ExceptionMiddleware
{

    public function __invoke(ExceptionEvent $event, callable $next): bool
    {
        // TODO: Implement __invoke() method.
        if (!$event->getThrowable() instanceof \ErrorException) {
            return $next($event);
        }
        dump('Handle error exception inside middleware');
        return self::SUCCESS;
    }
}