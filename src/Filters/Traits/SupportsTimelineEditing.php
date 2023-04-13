<?php

namespace ProjektGopher\FFMpegTools\Filters\Traits;

/**
 * Supports Timeline Editing
 *
 * @see https://ffmpeg.org/ffmpeg-filters.html#toc-Timeline-editing
 */
trait SupportsTimelineEditing
{
    public function enable(string $value): self
    {
        $this->properties['enable'] = $value;

        return $this;
    }
}
