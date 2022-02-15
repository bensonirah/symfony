<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Command\CommandInterface;
use Arch\Application\Response\ResponseInterface;

final class CommandValidatorMiddleware implements MiddlewareInterface
{

    public function __invoke(CommandInterface $commandInterface, callable $next): ResponseInterface
    {
        // TODO: Validate command
        return $next($commandInterface);
    }
}
