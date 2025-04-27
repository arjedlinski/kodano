<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use Money\Money;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MoneyNormalizer implements NormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Money;
    }

    public function normalize($data, string $format = null, array $context = []): array
    {
        return [
            'amount' => $data->getAmount(),
            'currency' => $data->getCurrency()->getCode(),
        ];
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Money::class => true];
    }
}
