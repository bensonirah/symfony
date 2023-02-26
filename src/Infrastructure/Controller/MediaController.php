<?php

namespace Arch\Infrastructure\Controller;

use Arch\Application\Media\BucketPath;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/media")
 */
class MediaController extends AbstractController
{
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @Route("/upload", name="upload_media",methods={"POST","GET"})
     */
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            dd($request->request->get(BucketPath::URL));
            return $this->redirectToRoute('upload_media');
        }

        return $this->render('medias/index.html.twig');
    }

    /**
     * @param Request $request
     * @param string $fileName
     * @param ParameterBagInterface $parameterBag
     * @return Response
     * @Route("/bucket/{fileName<[a-zA-Z0-9\.]+>}", name="fetch_media",methods={"GET"})
     */
    public function fetchMediaAction(Request $request, string $fileName, ParameterBagInterface $parameterBag): Response
    {
        $bucket = BucketPath::withFileName($parameterBag->get('bucket_dest'), $fileName);
        dd($bucket);
        return new BinaryFileResponse($bucket);
    }
}
