<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Enums\Ease;
use ProjektGopher\FFMpegTween\Keyframe;

class Timeline
{
    private array $keyframes = [];
    private array $tweens = [];

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

    public function buildTweens(): void
    {
        (int) $current_time = 0;

        foreach ($this->keyframes as $index => $keyframe) {
            if (! $keyframe instanceof Keyframe) {
                throw new \Exception('Keyframe is not of type Keyframe.');
            }

            if ($index === 0) {
                // $this->tweens[] = (new Tween())
                //     ->from($keyframe->value)
                //     ->to($keyframe->value)
                //     ->duration(new Timing(0))
                //     ->ease(Ease::Linear);
            }
            else {
                $this->tweens[] = (new Tween())
                    ->from($this->getKeyframeByIndex($index - 1)->value)
                    ->to($keyframe->value)
                    ->delay(Timing::seconds($current_time))
                    ->duration($keyframe->duration)
                    ->ease($keyframe->ease);
            }

            $current_time += $keyframe->hold?->seconds;
            $current_time += $keyframe->duration?->seconds;
        }
    }

    public function getKeyframeByIndex(int $index): Keyframe
    {
        return $this->keyframes[$index];
    }

    public function __toString(): string
    {
        if (count($this->tweens) === 0) {
            $this->buildTweens();
        }

        // clone the array so we don't modify the original
        $tweens = $this->tweens;

        // Initialize the timeline with the first tween.
        $timeline = array_shift($tweens);
        while ($tween = array_shift($tweens)) {
            // If the current time is greater than this tween's delay,
            // use the tween. Otherwise, use the previous timeline.
            $timeline = "if(gt(t\,{$tween->getDelay()})\,{$tween}\,{$timeline})";
        }

        return $timeline;
    }
}
