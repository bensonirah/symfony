<?php

namespace Arch\Application\Middlewares;


use Arch\Application\Response\ResponseInterface;
use Arch\Application\Response\ViewModel;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;


final class CommandHandlerMiddleware implements MiddlewareInterface
{

    /**
     * List of command handler
     *
     * @var array
     */
    private $commandHandlers;
    /**
     * The logger to log message in log file
     *
     * @var LoggerInterface
     */
    private $logger;


    /**
     * CommandHandlerMiddleware constructor.
     * @param iterable $commandHandlers
     * @param LoggerInterface $loggerInterface
     * @throws \ReflectionException
     */
    public function __construct(iterable $commandHandlers, LoggerInterface $loggerInterface)
    {
        foreach ($commandHandlers as $handler) {
            $this->commandHandlers[$this->commandFrom($handler)] = $handler;
        }
        $this->logger = $loggerInterface;
    }

    /**
     * Get an handler from className of a given command
     *
     *
     * @param string $commandClassName The className of a command
     * @return callable The command handler
     * @throws \InvalidArgumentException
     */
    private function getHandler(string $commandClassName): callable
    {
        if (!$handler = $this->commandHandlers[$commandClassName]) {
            throw new \InvalidArgumentException(
                sprintf("Unable to find handler for the command %s", $commandClassName),
                Response::HTTP_BAD_REQUEST
            );
        }
        return $handler;
    }

    /**
     * @param object $handler
     * @return string
     * @throws \ReflectionException
     */
    private function commandFrom(object $handler): string
    {
        $reflectionMethod = new \ReflectionMethod(get_class($handler), '__invoke');
        $parameters = $reflectionMethod->getParameters();
        return $parameters[0]->getClass()->getName();
    }

    public function __invoke(object $command, callable $next): ResponseInterface
    {
        try {
            $handler = $this->getHandler(get_class($command));
            return $handler($command);
        } catch (\Throwable $t) {
            $this->logger->error($t->getTraceAsString());
            return ViewModel::withValue([
                'data' => null,
                'message' => $t->getMessage(),
                'code' => Response::HTTP_BAD_REQUEST
            ]);
        }
    }
}
