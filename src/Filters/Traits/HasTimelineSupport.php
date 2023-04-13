<?php

namespace ProjektGopher\FFMpegTools\Filters\Traits;

trait HasTimelineSupport
{
    public function enable(string $value): self
    {
        $this->properties['enable'] = $value;

        return $this;
    }
}