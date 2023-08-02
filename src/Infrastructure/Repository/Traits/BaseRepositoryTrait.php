<?php

namespace Arch\Infrastructure\Repository\Traits;

use Arch\Domain\Entity\BaseEntity;
use Arch\Domain\Exception\DomainEntityException;
use Arch\Domain\Exception\EntityNotFoundException;

trait BaseRepositoryTrait
{
    protected string $className;

    /**
     * @throws DomainEntityException
     */
    public function get(int $id): BaseEntity
    {
        if (!$entity = $this->_em->find($this->className, $id)) {
            throw EntityNotFoundException::fromMessage(sprintf("Unable to find entity with ID: %s", $id));
        }
        return $entity;
    }

    public function add(BaseEntity $baseEntity)
    {
        if ($baseEntity->getId()) {
            $this->_em->flush();
            return;
        }
        $this->_em->persist($baseEntity);
        $this->_em->flush();
    }

    /**
     * @param int $id
     * @return void
     * @throws DomainEntityException
     */
    public function remove(int $id)
    {
        $oUser = $this->get($id);
        $this->_em->remove($oUser);
    }
}