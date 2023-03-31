<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Keyframe;

class Timeline
{
    private array $keyframes = [];

    public function keyframe(Keyframe $keyframe): self
    {
        /**
         * The first keyframe should never have an ease, or duration.
         */
        if (count($this->keyframes) === 0) {
            if ($keyframe->ease !== null) {
                throw new \Exception('The first keyframe should never have an ease.');
            }
            if ($keyframe->duration !== null) {
                throw new \Exception('The first keyframe should never have a duration.');
            }
        }

        $this->keyframes[] = $keyframe;

        return $this;
    }

    public function __toString()
    {
        return 'timeline'.implode('', $this->keyframes);
    }
}
