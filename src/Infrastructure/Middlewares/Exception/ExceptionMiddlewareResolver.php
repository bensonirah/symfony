<?php


namespace Arch\Infrastructure\Middlewares\Exception;


use Symfony\Component\DependencyInjection\ContainerInterface;

final class ExceptionMiddlewareResolver
{
    private array $middlewares;
    private array $middlewareClassNames;

    public function __construct(ContainerInterface $container, iterable $middlewares)
    {
        $middleware_paths = implode('/', [$container->get('kernel')->getProjectDir(), 'config/exception-middlewares.php']);
        if (file_exists($middleware_paths)) {
            $this->middlewareClassNames = require $middleware_paths;
            foreach ($middlewares as $middleware) {
                $this->middlewares[get_class($middleware)] = $middleware;
            }
        }
    }

    public function __invoke(): array
    {
        return array_map(fn(string $middlewaresFQCN) => $this->middlewares[$middlewaresFQCN], $this->middlewareClassNames);
    }
}