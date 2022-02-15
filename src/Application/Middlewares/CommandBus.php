<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Command\CommandInterface;
use Arch\Application\Response\ResponseInterface;

interface CommandBus
{
    public function dispatch(CommandInterface $commandInterface): ResponseInterface;
}
