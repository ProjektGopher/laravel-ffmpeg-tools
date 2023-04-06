<?php

namespace ProjektGopher\FFMpegTools;

use ProjektGopher\FFMpegTools\Utils\Expr;

class Tween
{
    protected string $from;

    protected string $to;

    protected string $duration = '0.3';

    protected string $delay = '0';

    protected string $ease;

    public function from(string $from): self
    {
        $this->from = "({$from})";

        return $this;
    }

    public function to(string $to): self
    {
        $this->to = "({$to})";

        return $this;
    }

    public function duration(Timing $duration): self
    {
        $this->duration = (string) $duration;

        return $this;
    }

    public function delay(Timing $delay): self
    {
        $this->delay = (string) $delay;

        return $this;
    }

    public function getDelay(): string
    {
        return $this->delay;
    }

    public function ease(Ease $ease): self
    {
        $this->ease = $ease->make("(t-{$this->delay})/{$this->duration}");

        return $this;
    }

    /**
     * This should always evaluate to a value between
     * zero and one.
     */
    private function getDelta(): string
    {
        return "({$this->to}-{$this->from})";
    }

    /**
     * Builds the tween string which can be used in an FFMpeg command.
     * This is called automatically at the end of the chain.
     */
    public function build(): string
    {
        if (! $this->ease) {
            $this->ease(Ease::Linear);
        }

        return Expr::if(
            x: Expr::lt('t', $this->delay),
            y: $this->from,
            z: Expr::if(
                x: Expr::gt('t', "{$this->delay}+{$this->duration}"),
                y: $this->to,
                z: "{$this->from}+({$this->getDelta()}*{$this->ease})"
            ),
        );
    }

    public function __toString(): string
    {
        return $this->build();
    }

    public static function __callStatic(string $name, array $arguments): self
    {
        return (new self)->$name(...$arguments);
    }
}
