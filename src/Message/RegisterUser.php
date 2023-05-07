<?php
declare(strict_types=1);

namespace Liox\B2B\Message;

readonly final class RegisterUser
{
    public function __construct(
        public string $username,
        public string $plainTextPassword,
    ) {}
}
