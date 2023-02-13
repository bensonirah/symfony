<?php
/**
 * The middleware stacks definition
 */
return [
    Arch\Infrastructure\Middlewares\NotFoundExceptionMiddleware::class,
    Arch\Infrastructure\Middlewares\ErrorExceptionMiddleware::class,
];