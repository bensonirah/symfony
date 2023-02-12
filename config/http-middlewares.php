<?php
/**
 * The middleware stacks definition
 */
return [
    Arch\Infrastructure\Middlewares\HttpLoggerMiddleware::class,
    Arch\Infrastructure\Middlewares\HttpLocalMiddleware::class,
    Arch\Infrastructure\Middlewares\FileUploadMiddleware::class,
];