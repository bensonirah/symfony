<?php

namespace Arch\Application\Media;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class BucketPath implements FilePathInterface
{
    private string $dest;
    const URL = 'bucket_url';
    const BUCKET_KEY = 'bucket_key';
    const BUCKET_DEST = 'bucket_dest';
    const BUCKET_URL_KEY = 'bucket_url_key';

    /**
     * @param string $dest
     */
    public function __construct(string $dest)
    {
        if (!file_exists($dest)) {
            throw new FileNotFoundException(sprintf("No such %s file found in your server", $dest));
        }
        $this->dest = $dest;
    }

    public function __toString(): string
    {
        return $this->dest;
    }
}