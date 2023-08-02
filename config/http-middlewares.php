<?php
/**
 * The middleware stacks definition
 */
return [
    \Arch\Infrastructure\Middlewares\Http\HttpLoggerMiddleware::class,
    \Arch\Infrastructure\Middlewares\Http\HttpLocalMiddleware::class,
    \Arch\Infrastructure\Middlewares\Http\FileUploadMiddleware::class,
];