<?php

namespace Arch\Infrastructure\Middlewares;

use Arch\Application\Media\BucketParameterNotDefinedException;
use Arch\Application\Media\BucketPath;
use Arch\Application\Media\FileUploadInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

final class FileUploadMiddleware implements HttpRequestMiddleware
{
    private FileUploadInterface $fileUpload;
    private string $bucketKey;
    private string $bucketDest;
    private string $bucketUrlKey;

    /**
     * @param FileUploadInterface $fileUpload
     * @param ContainerInterface $container
     * @throws BucketParameterNotDefinedException
     */
    public function __construct(FileUploadInterface $fileUpload, ContainerInterface $container)
    {
        $this->fileUpload = $fileUpload;
        $this->assertThatBucketEnvironmentValid($container);
        $this->bucketKey = $container->getParameter(BucketPath::BUCKET_KEY);
        $this->bucketDest = $container->getParameter(BucketPath::BUCKET_DEST);
        $this->bucketUrlKey = $container->getParameter(BucketPath::BUCKET_URL_KEY);
    }

    public function __invoke(Request $request, callable $next): IResponse
    {
        if (!$request->isMethod('POST')) {
            return ResponseDto::withoutResponse();
        }
        if (!$request->files->has($this->bucketKey)) {
            return ResponseDto::withoutResponse();
        }
        /**@var UploadedFile $file */
        $file = $request->files->get($this->bucketKey);
        $bucketUrl = $this->fileUpload->upload($file, new BucketPath($this->bucketDest));
        $request->request->add([
            $this->bucketUrlKey => $bucketUrl,
        ]);
        $request->files->remove($this->bucketKey);
        return ResponseDto::withoutResponse();
    }

    /**
     * @throws BucketParameterNotDefinedException
     */
    private function assertThatBucketEnvironmentValid(ContainerInterface $container)
    {
        if (!$container->hasParameter(BucketPath::BUCKET_KEY) ||
            !$container->hasParameter(BucketPath::BUCKET_DEST) || !$container->hasParameter(BucketPath::BUCKET_URL_KEY)) {
            throw new BucketParameterNotDefinedException();
        }
    }
}