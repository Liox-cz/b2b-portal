<?php
declare(strict_types=1);

namespace Liox\B2B\MessageHandler;

use Liox\B2B\Message\RemoveItemFromCart;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class RemoveItemFromCartHandler
{
    public function __invoke(RemoveItemFromCart $message): void
    {

    }
}
