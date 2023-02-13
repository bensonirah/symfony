<?php

namespace Arch\Infrastructure\Controller;

use Arch\Application\Constant\Media;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadMediaController extends AbstractController
{
    /**
     * @Route("/upload/media", name="upload_media",methods={"POST"})
     */
    public function index(Request $request): Response
    {
        $request->request->get(Media::URL);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UploadMediaController.php',
        ]);
    }
}
