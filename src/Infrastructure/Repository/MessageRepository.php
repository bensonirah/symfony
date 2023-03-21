<?php

namespace Arch\Infrastructure\Repository;

use Arch\Domain\Repository\MessageRepositoryInterface;
use Arch\Infrastructure\Traits\BaseRepositoryTrait;
use Doctrine\ORM\EntityManagerInterface;

final class MessageRepository  implements MessageRepositoryInterface
{
    use BaseRepositoryTrait;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}