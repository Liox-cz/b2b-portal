<?php
declare(strict_types=1);

namespace Liox\B2B\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Liox\B2B\Entity\User;
use Liox\B2B\Exceptions\UserNotFound;
use Liox\B2B\Value\UserId;
use Ramsey\Uuid\Uuid;

readonly final class UserRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}


    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }


    public function nextIdentity(): UserId
    {
        return new UserId(Uuid::uuid4()->toString());
    }


    public function get(UserId $userId): User
    {
        $project = $this->entityManager->find(User::class, $userId);

        return $project ?? throw new UserNotFound();
    }
}
