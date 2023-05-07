<?php

declare(strict_types=1);

namespace Liox\B2B\Entity;

use Liox\B2B\Doctrine\UserIdDoctrineType;
use Liox\B2B\Value\UserId;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UserIdDoctrineType::NAME, unique: true)]
        public readonly UserId $userId,

        #[ORM\Column(unique: true)]
        public readonly string $username,

        #[ORM\Column]
        public string $hashedPassword,
    ) {
    }


    public function getRoles(): array
    {
        // This is here just to satisfy the interface 🤦
        return ['ROLE_USER'];
    }


    public function eraseCredentials(): void
    {
        // This is here just to satisfy the interface 🤦
    }


    public function getUserIdentifier(): string
    {
        // This is here just to satisfy the interface 🤦
        return $this->userId->id;
    }


    public function getPassword(): ?string
    {
        // This is here just to satisfy the interface 🤦
        return $this->hashedPassword;
    }


    public function changePassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }
}
