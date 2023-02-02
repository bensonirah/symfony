<?php

namespace Arch\Domain\Repository;

use Arch\Domain\Entity\Message;
use Arch\Domain\Exception\MessageNotFoundException;

interface MessageRepository
{
    /**
     * @throws MessageNotFoundException
     */
    public function get(int $id): Message;
    public function add(Message $message);
    /**
     * @throws MessageNotFoundException
     */
    public function remove(int $id);
}
