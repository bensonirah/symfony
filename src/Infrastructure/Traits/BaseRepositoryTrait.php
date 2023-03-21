<?php

namespace Arch\Infrastructure\Traits;

use Arch\Domain\Entity\BaseEntity;
use Doctrine\ORM\EntityManagerInterface;

trait BaseRepositoryTrait
{
    protected EntityManagerInterface $entityManager;
    protected string $className;
    /**
     * @param int $id
     * @return BaseEntity
     */
    public function get(int $id): BaseEntity
    {
        return $this->entityManager->find($this->className, $id);
    }

    public function add(BaseEntity $baseEntity)
    {
        if ($baseEntity->getId() != null) {
            $this->entityManager->flush();
            return;
        }
        $this->entityManager->persist($baseEntity);
        $this->entityManager->flush();
    }

    public function remove(int $id)
    {
        dump($id);
        /*$entityBase = $this->get($id);
        $this->entityManager->remove($entityBase);
        $this->entityManager->flush();*/
    }
}