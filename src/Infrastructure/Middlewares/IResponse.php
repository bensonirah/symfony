<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpFoundation\Response;

interface IResponse
{
    public function hasResponse(): bool;

    public function get(): Response;
}