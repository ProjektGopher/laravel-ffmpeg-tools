<?php

namespace ProjektGopher\FFMpegTween\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ProjektGopher\FFMpegTween\FFMpegTween
 */
class FFMpegTween extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ProjektGopher\FFMpegTween\Tween::class;
    }
}
