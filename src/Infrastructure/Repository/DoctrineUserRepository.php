<?php

namespace Arch\Infrastructure\Repository;

use Arch\Domain\Entity\User;
use Arch\Domain\Repository\UserRepositoryInterface;
use Arch\Domain\ValueObject\UserId;
use Arch\Infrastructure\Entity\DoctrineUser;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;

    /**
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function add(User $user)
    {
        $oUser = new DoctrineUser();
        $this->entityManager->persist();
    }

    public function get(UserId $userId): User
    {
        // TODO: Implement get() method.
    }

    public function findById(UserId $userId): ?User
    {
        // TODO: Implement findById() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }
}