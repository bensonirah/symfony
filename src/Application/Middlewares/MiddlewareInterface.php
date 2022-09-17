<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Response\ResponseInterface;

interface MiddlewareInterface
{
    public function __invoke(object $command, callable $next): ResponseInterface;
}
