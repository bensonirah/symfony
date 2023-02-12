<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class NotFoundExceptionMiddleware implements ExceptionMiddleware
{

    public function __invoke(ExceptionEvent $event, callable $next)
    {
        // TODO: Implement __invoke() method.
        $next($event);
    }
}