<?php

namespace Arch\Application\Shared\Media;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploadInterface
{
    public function upload(UploadedFile $uploadedFile, FilePathInterface $filePath): string;
}