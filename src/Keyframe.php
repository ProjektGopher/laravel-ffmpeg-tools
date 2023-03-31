<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Enums\Ease;

class Keyframe
{
    public string $value;
    public ?Ease $ease = null;
    public ?Timing $duration = null;
    public ?Timing $hold = null;

    public function value(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function ease(Ease $ease): self
    {
        $this->ease = $ease;

        return $this;
    }

    public function duration(Timing $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function hold(Timing $hold): self
    {
        $this->hold = $hold;

        return $this;
    }
}
