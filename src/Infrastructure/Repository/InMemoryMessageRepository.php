<?php

namespace Arch\Infrastructure\Repository;

use Arch\Domain\Entity\BaseEntity;
use Arch\Domain\Entity\Message;
use Arch\Domain\Exception\MessageNotFoundException;
use Arch\Domain\Repository\MessageRepositoryInterface;

final class InMemoryMessageRepository implements MessageRepositoryInterface
{
    private array $messages = [];

    /**
     * @throws MessageNotFoundException
     */
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

    public function add(BaseEntity $baseEntity)
    {
        $this->messages[] = $baseEntity;
    }

    public function remove(int $id)
    {
        $this->messages[] = array_filter($this->messages, fn(Message $message) => $message->getId() != $id);
    }
}