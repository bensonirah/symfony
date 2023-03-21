<?php

namespace Arch\Domain\Repository;

use Arch\Domain\Entity\BaseEntity;
use Arch\Domain\Exception\EntityNotFoundException;

interface BaseEntityRepositoryInterface
{
    /**
     * @param int $id
     * @return BaseEntity
     * @throws EntityNotFoundException
     */
    public function get(int $id): BaseEntity;
    public function add(BaseEntity $baseEntity);
    /**
     * @throws EntityNotFoundException
     */
    public function remove(int $id);
}