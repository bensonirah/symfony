<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Command\CommandInterface;
use Arch\Application\Response\ResponseInterface;


final class ConnectedUserMiddleware implements MiddlewareInterface
{

    public function __invoke(CommandInterface $commandInterface, callable $next): ResponseInterface
    {
        // TODO: Set connectedUser attribute in command
        // $oUser = $this->security->getUser();
        return $next($commandInterface);
    }
}
