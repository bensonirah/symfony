<?php

namespace Arch\Application\Middlewares;


use Arch\Application\Command\CommandInterface;
use Arch\Application\Response\ResponseInterface;
use Arch\Application\Response\ViewModel;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;


final class CommandBusMiddleware implements CommandHandlerInterface
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


    public function __construct(iterable $commandHandlers, LoggerInterface $loggerInterface)
    {
        foreach ($commandHandlers as $handler) {
            $this->commandHandlers[$this->commandFrom($handler)] = $handler;
        }
        $this->logger = $loggerInterface;
    }

    public function __invoke(CommandInterface $commandInterface): ResponseInterface
    {
        try {
            $handler = $this->getHandler(get_class($commandInterface));
            return $handler($commandInterface);
        } catch (\Throwable $t) {
            $this->logger->error($t->getTraceAsString());
            return ViewModel::withValue([
                'data' => null,
                'message' => $t->getMessage(),
                'code' => Response::HTTP_BAD_REQUEST
            ]);
        }
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

    private function commandFrom(object $handler): string
    {
        $reflectionMethod = new \ReflectionMethod(get_class($handler), '__invoke');
        $parameters = $reflectionMethod->getParameters();
        return $parameters[0]->getClass()->getName();
    }
}
