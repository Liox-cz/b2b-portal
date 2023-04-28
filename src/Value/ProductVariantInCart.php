<?php
declare(strict_types=1);

namespace Liox\B2B\Value;

use Liox\B2B\Entity\ProductVariant;

readonly final class ProductVariantInCart
{
    public function __construct(
        public ProductVariant $variant,
        public null|Dimensions $dimensions,
    ) {
    }
}
