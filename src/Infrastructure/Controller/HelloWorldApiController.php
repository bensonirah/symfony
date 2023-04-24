<?php

namespace Arch\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="api/hello")
 */
class HelloWorldApiController extends AbstractController
{
    /**
     * @Route("/world", name="arch_hello_world_api")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Hello World!'
        ]);
    }
}
