<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Response\ResponseInterface;


final class ConnectedUserMiddleware implements MiddlewareInterface
{

    public function __invoke(object $command, callable $next): ResponseInterface
    {
        dump('Inside ConnectedUserMiddleware', $command);
        return $next($command);
    }
}
