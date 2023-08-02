<?php

namespace Arch\Infrastructure\Middlewares\Exception;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

interface ExceptionMiddleware
{
    const SUCCESS = true;
    const FAILURE = false;

    /**
     * @param ExceptionEvent $event
     * @param callable $next The nex middleware
     * @return bool Either true or false depend on the event is handled or no
     */
    public function __invoke(ExceptionEvent $event, callable $next): bool;
}