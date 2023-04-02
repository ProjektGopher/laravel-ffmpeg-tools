<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Utils\Expr;

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

        // if t is less than delay, from
        // else if t is greater than delay + duration, to
        //      else, from + delta*ease

        // return "if(lt(t\,{$this->delay})\,{$this->from}\,if(gt(t\,{$this->delay}+{$this->duration})\,{$this->to}\,{$this->from}+({$this->getDelta()}*{$this->ease})))";

        return Expr::if(
            Expr::lt('t', $this->delay),
            $this->from,
            Expr::if(
                Expr::gt('t', "{$this->delay}+{$this->duration}"),
                $this->to,
                "{$this->from}+({$this->getDelta()}*{$this->ease})"
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
