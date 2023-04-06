<?php

namespace ProjektGopher\FFMpegTools;

class Timing
{
    public function __construct(
        public float $seconds,
    ) {
    }

    public static function seconds(float $seconds): self
    {
        return new self($seconds);
    }

    public static function milliseconds(int $milliseconds): self
    {
        return new self($milliseconds / 1000);
    }

    public static function ms(int $milliseconds): self
    {
        return self::milliseconds($milliseconds);
    }

    public function __toString(): string
    {
        return (string) $this->seconds;
    }
}
