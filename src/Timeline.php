<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Keyframe;

class Timeline
{
    private array $keyframes = [];

    public function keyframe(Keyframe $keyframe): self
    {
        $this->keyframes[] = $keyframe;

        return $this;
    }

    public function __toString()
    {
        return 'timeline'.implode('', $this->keyframes);
    }
}
