<?php

namespace Arch\Application\Shared\Media;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class BucketFileStorage implements FileUploadInterface
{
    private string $host;

    /**
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
    }

    public function upload(UploadedFile $uploadedFile, FilePathInterface $filePath): string
    {
        $filename = implode('.', [uniqid(), $uploadedFile->getClientOriginalExtension()]);
        $uploadedFile->move($filePath, $filename);
        return $this->host . implode('/', [$filePath, $filename]);
    }
}
