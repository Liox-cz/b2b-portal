<?php

declare(strict_types=1);

use Liox\B2B\Services\Cart\CartStorage;
use Liox\B2B\Services\Cart\InMemoryCartStorage;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function(ContainerConfigurator $configurator): void
{
    $services = $configurator->services();

    $services->defaults()
        ->autoconfigure()
        ->autowire()
        ->public();

    $services->alias(CartStorage::class, InMemoryCartStorage::class);
};
