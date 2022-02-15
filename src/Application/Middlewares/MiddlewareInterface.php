<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Command\CommandInterface;
use Arch\Application\Response\ResponseInterface;

interface MiddlewareInterface
{
    public function __invoke(CommandInterface $commandInterface, callable $next): ResponseInterface;
}
