<?php
declare(strict_types=1);

namespace Liox\B2B\Tests\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class TestDataFixture extends Fixture
{
    public const PRODUCT_ID = 'bc6838d6-abea-11ed-b5af-1266a710edb3';
    public const VARIANT_1_ID = 'c8481586-abea-11ed-805e-1266a710edb3';
    public const VARIANT_2_ID = 'c892da3a-abea-11ed-b091-1266a710edb3';


    public function load(ObjectManager $manager): void
    {
        $manager->flush();
    }
}
