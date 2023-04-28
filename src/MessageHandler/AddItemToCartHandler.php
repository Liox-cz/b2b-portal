<?php
declare(strict_types=1);

namespace Liox\B2B\MessageHandler;

use Liox\B2B\Message\AddItemToCart;
use Liox\B2B\Services\Cart\CartStorage;
use Liox\B2B\Value\CartItem;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly final class AddItemToCartHandler
{
    public function __construct(
        private CartStorage $cartStorage,
    ) {
    }

    public function __invoke(AddItemToCart $message): void
    {
        $item = new CartItem($message->productVariantId, null);

        $this->cartStorage->addItem($item);
    }
}
