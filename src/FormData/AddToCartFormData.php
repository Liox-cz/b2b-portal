<?php
declare(strict_types=1);

namespace Liox\B2B\FormData;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Uuid;

final class AddToCartFormData
{
    #[NotBlank]
    #[Uuid]
    public string $variantId = '';
}
