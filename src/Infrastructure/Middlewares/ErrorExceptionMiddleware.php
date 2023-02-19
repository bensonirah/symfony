<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

final class ErrorExceptionMiddleware implements ExceptionMiddleware
{

    public function __invoke(ExceptionEvent $event, callable $next): bool
    {
        $throwable = $event->getThrowable();
        if (!$this->support($throwable)) {
            return false;
        }
        dump('Handle error exception inside middleware');
        return self::SUCCESS;
    }

    private function support(\Throwable $throwable): bool
    {
        return $throwable instanceof \ErrorException || $throwable instanceof MethodNotAllowedHttpException;
    }
}