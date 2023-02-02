<?php

namespace Arch\Infrastructure\Repository;

use Arch\Domain\Entity\Message;
use Arch\Domain\Exception\MessageNotFoundException;
use Arch\Domain\Repository\MessageRepository;

final class InMemoryMessageRepository implements MessageRepository
{
    private $messages = [];

    public function get(int $id): Message
    {
        if (!empty($this->messages)) {
            $items = array_filter($this->messages, fn(Message $m) => $m->getId() == $id);
            if (empty($items)) {
                throw MessageNotFoundException::fromId($id);
            }
            return $items[0];
        }
        throw new MessageNotFoundException('No message found!');
    }

    public function add(Message $message)
    {

    }

    public function remove(int $id)
    {
        // TODO: Implement remove() method.
    }
}