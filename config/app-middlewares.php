<?php
/**
 * The middleware stacks definition
 */
return [
    Arch\Application\Middlewares\ConnectedUserMiddleware::class,
    Arch\Application\Middlewares\CommandValidatorMiddleware::class,
    Arch\Application\Middlewares\CommandHandlerMiddleware::class,
];