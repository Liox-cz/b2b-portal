<?php
declare(strict_types=1);

namespace Liox\B2B\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Liox\B2B\Entity\ProductVariant;

readonly final class ProductVariantRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    /**
     * @return list<ProductVariant>
     */
    public function findAll(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('product_variant')
            ->from(ProductVariant::class, 'product_variant')
            ->join('product_variant.product', 'product')
            ->addSelect('product')
            ->getQuery()
            ->getResult();
    }
}
