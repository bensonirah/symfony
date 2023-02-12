<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpFoundation\Request;

final class HttpLocalMiddleware implements HttpRequestMiddleware
{

    public function __invoke(Request $request, callable $next): IResponse
    {
        // TODO: Implement __invoke() method.
        dump('Handle http local for language support!');
        return $next($request);
    }
}