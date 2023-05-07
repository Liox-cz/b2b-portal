<?php
declare(strict_types=1);

namespace Liox\B2B\Services\Security;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final class SymfonyHashPlainTextPassword implements HashPlainTextPassword
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {}


    public function hash(string $plainTextPassword): string
    {
        $user = new class implements PasswordAuthenticatedUserInterface {
            public function getPassword(): ?string
            {
                return null;
            }
        };

        return $this->userPasswordHasher->hashPassword($user, $plainTextPassword);
    }
}
