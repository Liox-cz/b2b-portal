<?php
declare(strict_types=1);

namespace Liox\B2B\Services\Security;

interface HashPlainTextPassword
{
    public function hash(string $plainTextPassword): string;
}
