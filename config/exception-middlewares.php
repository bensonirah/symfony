<?php
/**
 * The middleware stacks definition
 */
return [
    \Arch\Infrastructure\Middlewares\Exception\NotFoundExceptionMiddleware::class,
    \Arch\Infrastructure\Middlewares\Exception\ErrorExceptionMiddleware::class,
];