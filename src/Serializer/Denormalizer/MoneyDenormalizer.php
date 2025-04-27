<?php
declare(strict_types=1);

namespace App\Serializer\Denormalizer;

use Money\Currency;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use UnexpectedValueException;

class MoneyDenormalizer implements DenormalizerInterface
{
    public function getSupportedTypes(?string $format): array
    {
        return [Money::class => true];
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (!isset($data['amount']) || !isset($data['currency'])) {
            throw new UnexpectedValueException('Invalid data to denormalize Money object');
        }

        $currency = new Currency($data['currency']);
        return new Money((int) $data['amount'], $currency);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $format === 'jsonld' && Money::class === $type;
    }
}