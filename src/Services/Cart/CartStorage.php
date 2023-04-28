<?php
declare(strict_types=1);

namespace Liox\B2B\Services\Cart;

use Liox\B2B\Value\CartItem;

interface CartStorage
{
    public function addItem(CartItem $item): void;

    /**
     * @return list<CartItem>
     */
    public function getItems(): array;

    public function removeItem(CartItem $itemToRemove): void;

    public function clear(): void;
}
