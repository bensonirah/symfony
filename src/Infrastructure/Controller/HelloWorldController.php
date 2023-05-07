<?php

namespace Arch\Infrastructure\Controller;

use Arch\Application\Command\HelloWorld;
use Arch\Application\CommandBus;
use Arch\Application\Events\EventBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    private CommandBus $commandBus;
    private EventBusInterface $eventBus;

    /**
     * @param CommandBus $commandBus
     * @param EventBusInterface $eventBus
     */
    public function __construct(CommandBus $commandBus, EventBusInterface $eventBus)
    {
        $this->commandBus = $commandBus;
        $this->eventBus = $eventBus;
    }

    /**
     * @Route("/hello/world",methods={"GET"}, name="hello_world")
     */
    public function index(): Response
    {
        $commandDto = new HelloWorld('Hello world');
        $response = $this->commandBus->dispatch($commandDto);

        if ($response->hasEvent()) {
            $this->eventBus->dispatch($response->events());
        }
        $dtoResponse = array_merge(
            $response->render(),
            [
                'controller_path' => controller($this),
                'controller_name' => controller_name($this),
                'event_message' => 'Check your log to see the event message dispatched',
            ]
        );
        return $this->render('helloworld/index.html.twig', $dtoResponse);
    }
}
