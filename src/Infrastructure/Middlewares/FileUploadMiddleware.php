<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpFoundation\Request;

final class FileUploadMiddleware implements HttpRequestMiddleware
{
    public function __invoke(Request $request, callable $next): IResponse
    {
        return ResponseDto::withoutResponse();
    }
}