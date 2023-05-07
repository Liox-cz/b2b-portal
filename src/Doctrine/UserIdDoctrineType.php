<?php

declare(strict_types=1);

namespace Liox\B2B\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Liox\B2B\Value\UserId;

final class UserIdDoctrineType extends Type
{
    public const NAME = 'user_id';


    public function getName(): string
    {
        return self::NAME;
    }


    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }


    /**
     * @param UserId $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->id;
    }


    /**
     * @param string $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): UserId
    {
        return new UserId($value);
    }


    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
