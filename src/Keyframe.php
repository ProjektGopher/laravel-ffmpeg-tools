<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Enums\Ease;

class Keyframe
{
    public string $value;
    public Ease $ease;
    public Timing $duration;
    public Timing $hold;

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
    
    public function __toString()
    {
        return 'keyframe';
    }
}
