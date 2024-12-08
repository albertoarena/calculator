<?php

namespace Calculator\Operators;

use Calculator\Enums\AngleMeasureEnum;

abstract class TrigonometricOperator extends Operator
{
    public function __construct(
        protected readonly AngleMeasureEnum $measure = AngleMeasureEnum::Radians,
    ) {}

    protected function toDegrees(int|float|null $value): float|int
    {
        return is_null($value) ? 0 : match ($this->measure) {
            AngleMeasureEnum::Radians => rad2deg($value),
            default => $value,
        };
    }

    protected function toRadians(int|float|null $value): float|int
    {
        return is_null($value) ? 0 : match ($this->measure) {
            AngleMeasureEnum::Degrees => deg2rad($value),
            default => $value,
        };
    }

    protected function toResult(int|float $result): float|int
    {
        return match ($this->measure) {
            AngleMeasureEnum::Degrees => rad2deg($result),
            default => $result,
        };
    }

    public function useRadians(): bool
    {
        return AngleMeasureEnum::Radians === $this->measure;
    }

    public function useDegrees(): bool
    {
        return AngleMeasureEnum::Degrees === $this->measure;
    }
}
