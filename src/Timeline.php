<?php

namespace ProjektGopher\FFMpegTools;

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

            // Skip the first keyframe, as the values will be baked into the next tween.
            if ($index !== 0) {
                $this->tweens[] = (new Tween())
                    ->from($this->getKeyframeByIndex($index - 1)->value)
                    ->to($keyframe->value)
                    ->delay(Timing::seconds($current_time))
                    ->duration($keyframe->duration ?? Timing::seconds(0))
                    ->ease($keyframe->ease ?? Ease::Linear);
            }

            $current_time += $keyframe->hold?->seconds;
            $current_time += $keyframe->duration?->seconds;
        }
    }

    public function getKeyframeByIndex(int $index): Keyframe
    {
        return $this->keyframes[$index];
    }

    public function build(): string
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

    public function __toString(): string
    {
        return $this->build();
    }
}
