<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Shared\Response\ResponseInterface;

final class CommandValidatorMiddleware implements MiddlewareInterface
{

    public function __invoke(object $command, callable $next): ResponseInterface
    {
        return $next($command);
    }
}
