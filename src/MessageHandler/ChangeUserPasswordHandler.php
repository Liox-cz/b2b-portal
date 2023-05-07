<?php

declare(strict_types=1);

namespace Liox\B2B\MessageHandler;

use Liox\B2B\Exceptions\UserNotFound;
use Liox\B2B\Message\ChangeUserPassword;
use Liox\B2B\Repository\UserRepository;
use Liox\B2B\Services\Security\HashPlainTextPassword;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly final class ChangeUserPasswordHandler
{
    public function __construct(
        private UserRepository        $userRepository,
        private HashPlainTextPassword $hashPlainTextPassword,
    ) {}


    /**
     * @throws UserNotFound
     */
    public function __invoke(ChangeUserPassword $command): void
    {
        $user = $this->userRepository->get($command->userId);
        $hashedNewPassword = $this->hashPlainTextPassword->hash($command->plainTextNewPassword);

        $user->changePassword($hashedNewPassword);

        $this->userRepository->save($user);
    }
}
