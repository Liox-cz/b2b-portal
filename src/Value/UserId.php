<?php
declare(strict_types=1);

namespace Liox\B2B\Value;

final class UserId implements \Stringable
{
    public function __construct(
        public readonly string $id
    ) {}


    public function __toString()
    {
        return $this->id;
    }
}
