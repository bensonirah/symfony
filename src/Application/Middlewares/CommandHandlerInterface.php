<?php

namespace Arch\Application\Middlewares;

use Arch\Application\Command\CommandInterface;
use Arch\Application\Response\ResponseInterface;

interface CommandHandlerInterface
{
    public function __invoke(CommandInterface $commandInterface): ResponseInterface;
}
