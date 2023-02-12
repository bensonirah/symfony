<?php

namespace Arch\Infrastructure\Middlewares;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class HttpLoggerMiddleware implements HttpRequestMiddleware
{
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Request $request, callable $next): IResponse
    {
        // TODO: Implement __invoke() method.
        $this->logger->debug($request->getRequestUri());
        dump(sprintf("%s Log the http request...", __CLASS__));
        return $next($request);
    }
}