<?php

namespace Arch\Infrastructure\Middlewares\Http;

use Symfony\Component\HttpFoundation\Request;

interface HttpRequestMiddleware
{
    public function __invoke(Request $request, callable $next): IResponse;
}