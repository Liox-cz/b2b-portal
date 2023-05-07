<?php

declare(strict_types=1);

namespace Liox\B2B\Services\ControllerValueResolvers;

use Liox\B2B\Value\UserId;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Controller\UserValueResolver;

final class UserIdValueResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly Security $security,
    ) {}


    /**
     * @see UserValueResolver
     *
     * @return array<null|UserId>
     *
     * @throws AccessDeniedException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $user = $this->security->getUser();

        if ($argument->getType() !== UserId::class) {
            return [];
        }

        if ($user === null) {
            if (!$argument->isNullable()) {
                throw new AccessDeniedException(sprintf('There is no logged-in user to pass to $%s, make the argument nullable if you want to allow anonymous access to the action.', $argument->getName()));
            }

            return [null];
        }

        return [new UserId($user->getUserIdentifier())];
    }
}
