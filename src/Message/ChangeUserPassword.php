<?php

declare(strict_types=1);

namespace Liox\B2B\Message;

use Liox\B2B\Value\UserId;

readonly final class ChangeUserPassword
{
    public function __construct(
        public UserId $userId,
        public string $plainTextNewPassword,
    ) {}
}
