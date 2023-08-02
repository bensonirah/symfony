<?php

namespace Arch\Domain\Repository;

use Arch\Domain\Entity\User;
use Arch\Domain\Exception\UserNotFoundException;
use Arch\Domain\ValueObject\UserId;

interface UserRepositoryInterface
{
    public function add(User $user);

    /**
     * @param UserId $userId
     * @throws UserNotFoundException
     */
    public function get(UserId $userId): User;

    /**
     * @param UserId $userId
     * @return User|null
     */
    public function findById(UserId $userId): ?User;

    /**
     * @return User[]
     */
    public function findAll(): array;
}