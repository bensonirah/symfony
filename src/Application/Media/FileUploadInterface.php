<?php

namespace Arch\Application\Media;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploadInterface
{
    public function upload(UploadedFile $uploadedFile, FilePathInterface $filePath): string;
}