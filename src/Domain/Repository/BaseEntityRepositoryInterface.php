<?php

namespace Arch\Domain\Repository;

use Arch\Domain\Entity\BaseEntity;
use Arch\Domain\Exception\DomainEntityException;

/**
 * @method BaseEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseEntity[]    findAll()
 * @method BaseEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface BaseEntityRepositoryInterface
{
    /**
     * @param int $id
     * @return BaseEntity
     * @throws DomainEntityException
     */
    public function get(int $id): BaseEntity;
    public function add(BaseEntity $baseEntity);
    /**
     * @throws DomainEntityException
     */
    public function remove(int $id);
}