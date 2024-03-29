<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Shared\Response\ResponseInterface;


final class ConnectedUserMiddleware implements MiddlewareInterface
{

    public function __invoke(object $command, callable $next): ResponseInterface
    {
        return $next($command);
    }
}
