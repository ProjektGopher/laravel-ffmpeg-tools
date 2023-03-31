<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Enums\Ease as AvailableEasings;

class Tween
{
    protected string $from;

    protected string $to;

    protected string $duration = '0.3';

    protected string $delay = '0';

    protected string $ease;

    public function from($from): self
    {
        $this->from = "({$from})";

        return $this;
    }

    public function to($to): self
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

    public function ease(AvailableEasings $ease): self
    {
        $easeString = Ease::{$ease->value}("(t-{$this->delay})/{$this->duration}");
        $this->ease = "({$easeString})";

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
            $this->ease(AvailableEasings::Linear);
        }

        // if t is less than delay, from
        // else if t is greater than delay + duration, to
        //      else, from + delta*ease

        // if( lt(t,{$this->delay}),
        //   {$this->from},
        //   if( gt(t,{$this->delay}+{$this->duration}),
        //     {$this->to},
        //     {$this->from}+({$this->getDelta()}*{$this->ease})
        //   )
        // )
        return "if(lt(t\,{$this->delay})\,{$this->from}\,if(gt(t\,{$this->delay}+{$this->duration})\,{$this->to}\,{$this->from}+({$this->getDelta()}*{$this->ease})))";
    }

    public function __toString(): string
    {
        return $this->build();
    }

    public static function __callStatic($name, $arguments): self
    {
        return (new self)->$name(...$arguments);
    }
}
