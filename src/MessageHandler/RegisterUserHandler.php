<?php
declare(strict_types=1);

namespace Liox\B2B\MessageHandler;

use Liox\B2B\Entity\User;
use Liox\B2B\Message\RegisterUser;
use Liox\B2B\Repository\UserRepository;
use Liox\B2B\Services\Security\HashPlainTextPassword;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly final class RegisterUserHandler
{
    public function __construct(
        private UserRepository        $userRepository,
        private HashPlainTextPassword $hashPlainTextPassword,
    ) {}


    public function __invoke(RegisterUser $command): void
    {
        $userId = $this->userRepository->nextIdentity();
        $hashedPassword = $this->hashPlainTextPassword->hash($command->plainTextPassword);

        $user = new User(
            $userId,
            $command->username,
            $hashedPassword,
        );

        $this->userRepository->save($user);
    }
}
