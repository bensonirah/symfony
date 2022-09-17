<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Response\ResponseInterface;

final class CommandValidatorMiddleware implements MiddlewareInterface
{

    public function __invoke(object $command, callable $next): ResponseInterface
    {
        // TODO: Validate command
        dump('Inside CommandValidator', $command);
        return $next($command);
    }
}
