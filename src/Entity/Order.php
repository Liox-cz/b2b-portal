<?php
declare(strict_types=1);

namespace Liox\B2B\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Liox\B2B\Doctrine\AddressDoctrineType;
use Liox\B2B\Value\Address;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
class Order
{
    /**
     * @param Collection<int, OrderItem> $items
     */
    private function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME, unique: true)]
        public readonly UuidInterface $id,

        #[ORM\Column(type: AddressDoctrineType::NAME)]
        public readonly Address $shippingAddress,

        #[ORM\Column(type: AddressDoctrineType::NAME, nullable: true)]
        public readonly null|Address $invoicingAddress,

        #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderItem::class)]
        public readonly Collection $items,
    ) {
    }
}
