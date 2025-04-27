<?php

declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Money\Currency;
use Money\Money;

class MoneyType extends Type
{
    public const MONEY = 'money';
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Money
    {
        if ($value === null) {
            return null;
        }

        return new Money($value, new Currency('PLN'));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return $value->getAmount();
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return "BIGINT";
    }

    public function getName(): string
    {
        return self::MONEY;
    }
}
