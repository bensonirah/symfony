<?php

namespace Arch\Infrastructure\Middlewares\Http;

use Symfony\Component\HttpFoundation\Response;

interface IResponse
{
    public function hasResponse(): bool;

    public function get(): Response;
}