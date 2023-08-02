<?php

namespace Arch\Application\Query\Message;

final class GetMessage
{
    private int $messageId;

    /**
     * @param int $messageId
     */
    public function __construct(int $messageId)
    {
        $this->messageId = $messageId;
    }

    public function messageId(): int
    {
        return $this->messageId;
    }
}