<?php

declare(strict_types=1);

namespace Liox\B2B\Services\ControllerValueResolvers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class DomainIdValueResolver implements ValueResolverInterface
{
    /**
     * @var array<class-string>
     */
    private static array $supportedClasses = [
    ];


    /**
     * @return array<null|object>
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $attributeValue = $request->attributes->get($argument->getName());

        if (in_array($argument->getType(), self::$supportedClasses, true) === false) {
            return [];
        }

        if ($attributeValue === null && $argument->isNullable()) {
            return [null];
        }

        if (is_string($attributeValue) === false) {
            return [];
        }

        foreach (self::$supportedClasses as $class) {
            if ($class === $argument->getType()) {
                return [new $class($attributeValue)];
            }
        }

        return [];
    }
}
