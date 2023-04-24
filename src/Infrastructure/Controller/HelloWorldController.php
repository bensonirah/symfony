<?php

namespace Arch\Infrastructure\Controller;

use Arch\Application\Command\HelloWorld;
use Arch\Application\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    private CommandBus $commandBus;
    private MessageBusInterface $messageBus;

    /**
     * @param CommandBus $commandBus
     * @param MessageBusInterface $messageBus
     */
    public function __construct(CommandBus $commandBus, MessageBusInterface $messageBus)
    {
        $this->commandBus = $commandBus;
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/hello/world",methods={"GET"}, name="hello_world")
     */
    public function index(): Response
    {
        $commandDto = new HelloWorld('Hello world');
        $response = $this->commandBus->dispatch($commandDto);
        if ($response->hasEvent()) {
            $this->messageBus->dispatch($response->events());
        }
        $data = $response->render();
//        return $this->json(array_merge($response->render(), [
//            'path' => 'src/Infrastructure/Controller/HelloWorldController.php',
//            'event_message' => 'Check your log to see the event message dispatched',
//        ]), $data['status']);

        return $this->render('helloworld/index.html.twig', array_merge($response->render(), [
            'controller_path' => 'src/Infrastructure/Controller/HelloWorldController.php',
            'controller_name' => basename('src/Infrastructure/Controller/HelloWorldController.php'),
            'event_message' => 'Check your log to see the event message dispatched',
        ]));
    }
}
