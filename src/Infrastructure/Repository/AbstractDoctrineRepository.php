<?php

namespace Arch\Infrastructure\Repository;

use Arch\Infrastructure\Repository\Traits\BaseRepositoryTrait;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractDoctrineRepository
{

    use BaseRepositoryTrait;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string $className
     */
    public function __construct(EntityManagerInterface $entityManager, string $className)
    {
        $this->entityManager = $entityManager;
        $this->className = $className;
    }
}