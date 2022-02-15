<?php

namespace Arch\Infrastructure\Controller;

use Arch\Application\Command\HelloWorld;
use Arch\Application\Middlewares\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/hello/world",methods={"GET"}, name="hello_world")
     */
    public function index(): Response
    {
        $commandDto = new HelloWorld('Hello world');
        $response = $this->commandBus->dispatch($commandDto);
        $data = $response->render();
        return $this->json(array_merge($response->render(), [
            'path' => 'src/Infrastructure/Controller/HelloWorldController.php',
            'event_message' => 'Check your log to see the event message dispatched',
        ]), $data['status']);
    }
}
