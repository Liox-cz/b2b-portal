<?php
declare(strict_types=1);

namespace Liox\B2B\Message;

use Ramsey\Uuid\UuidInterface;

readonly final class AddItemToCart
{
    public function __construct(
        public UuidInterface $productVariantId,
    ) {}
}
