<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

interface ExceptionMiddleware
{
    public function __invoke(ExceptionEvent $event, callable $next);
}