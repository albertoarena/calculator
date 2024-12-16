<?php

namespace Calculator\Factories;

use Calculator\Concerns\HasPhi;
use Calculator\Contracts\MathConstantInterface;
use Calculator\Numbers\MathConstant;

class MathConstantFactory
{
    use HasPhi;

    protected static array $constants = [
        MathConstantInterface::PI => M_PI,
        MathConstantInterface::PI_ALIAS => M_PI,
        MathConstantInterface::E => M_E,
        MathConstantInterface::PHI => '@phi',
        MathConstantInterface::PHI_ALIAS => '@phi',
    ];

    protected static function decodeConstant(string $value): string
    {
        return match ($value) {
            MathConstantInterface::PI_ALIAS => MathConstantInterface::PI,
            MathConstantInterface::PHI_ALIAS => MathConstantInterface::PHI,
            default => $value,
        };
    }

    protected static function decodeConstantAsGreekLetter(string $value): string
    {
        return match ($value) {
            MathConstantInterface::PI => MathConstantInterface::PI_ALIAS,
            MathConstantInterface::PHI => MathConstantInterface::PHI_ALIAS,
            default => $value,
        };
    }

    protected static function decodeValue(float|int|string $value): float|int|string
    {
        return match ($value) {
            '@phi' => self::getPhi(),
            default => $value,
        };
    }

    public static function getAsConstant(
        float|int|string $value,
        bool $greekLetters = false
    ): ?MathConstant {
        $value = is_string($value) ? strtolower($value) : $value;

        if (array_key_exists($value, self::$constants)) {
            return new MathConstant(
                $greekLetters ? self::decodeConstantAsGreekLetter($value) : self::decodeConstant($value),
                self::decodeValue(self::$constants[$value]),
                $greekLetters
            );
        }

        return null;
    }
}
