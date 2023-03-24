<?php

namespace Arch\Infrastructure\Middlewares;

use Symfony\Component\HttpFoundation\Response;

final class ResponseDto implements IResponse
{
    private bool $hasResponse;

    /**
     * @param bool $hasResponse
     */
    public function __construct(bool $hasResponse)
    {
        $this->hasResponse = $hasResponse;
    }

    public static function withoutResponse(): IResponse
    {
        return new self(false);
    }

    public function hasResponse(): bool
    {
        return $this->hasResponse;
    }

    public function get(): Response
    {
        // TODO: Implement get() method.
    }
}