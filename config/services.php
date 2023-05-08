<?php

declare(strict_types=1);

use Liox\B2B\Services\ControllerValueResolvers\DomainIdValueResolver;
use Liox\B2B\Services\ControllerValueResolvers\UserIdValueResolver;
use Liox\B2B\Services\Security\HashPlainTextPassword;
use Liox\B2B\Services\Security\SymfonyHashPlainTextPassword;
use Monolog\Processor\PsrLogMessageProcessor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

return static function(ContainerConfigurator $configurator): void
{
    $parameters = $configurator->parameters();

    # https://symfony.com/doc/current/performance.html#dump-the-service-container-into-a-single-file
    $parameters->set('container.dumper.inline_factories', true);

    $services = $configurator->services();

    $services->defaults()
        ->autoconfigure()
        ->autowire()
        ->public();

    $services->set(PdoSessionHandler::class)
        ->args([
            env('DATABASE_URL'),
        ]);

    $services->set(PsrLogMessageProcessor::class)
        ->tag('monolog.processor');

    // Controllers
    $services->load('Liox\\B2B\\Controller\\', __DIR__ . '/../src/Controller/{*Controller.php}');

    // CLI commands
    $services->load('Liox\\B2B\\Console\\', __DIR__ . '/../src/Console/**/{*.php}');

    // Repositories
    $services->load('Liox\\B2B\\Repository\\', __DIR__ . '/../src/Repository/{*Repository.php}');

    // Message handlers
    $services->load('Liox\\B2B\\MessageHandler\\', __DIR__ . '/../src/MessageHandler/**/{*.php}');

    // Services
    $services->load('Liox\\B2B\\Services\\', __DIR__ . '/../src/Services/**/{*.php}');
    $services->load('Liox\\B2B\\Query\\', __DIR__ . '/../src/Query/**/{*.php}');

    // Value resolvers
    $services->set(DomainIdValueResolver::class)
        ->tag('controller.argument_value_resolver', ['priority' => 110]);

    $services->set(UserIdValueResolver::class)
        ->tag('controller.argument_value_resolver', ['priority' => 110]);

    $services->set(SymfonyHashPlainTextPassword::class);
    $services->alias(HashPlainTextPassword::class, SymfonyHashPlainTextPassword::class);
};
