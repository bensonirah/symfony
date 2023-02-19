<?php

namespace Arch\Infrastructure\Controller;

use Arch\Application\Media\BucketPath;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadMediaController extends AbstractController
{
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @Route("/upload/media", name="upload_media",methods={"POST","GET"})
     */
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            dd($request->request->get(BucketPath::URL));
            return $this->redirectToRoute('upload_media');
        }

        return $this->render('medias/index.html.twig');
    }
}
