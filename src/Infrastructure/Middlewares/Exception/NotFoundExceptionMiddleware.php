<?php

namespace Arch\Infrastructure\Middlewares\Exception;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class NotFoundExceptionMiddleware implements ExceptionMiddleware
{

    public function __invoke(ExceptionEvent $event, callable $next): bool
    {
        // TODO: Implement __invoke() method.
        if (!$event->getThrowable() instanceof NotFoundHttpException) {
            return $next($event);
        }
        return self::SUCCESS;
    }
}