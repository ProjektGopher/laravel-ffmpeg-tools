<?php

namespace ProjektGopher\FFMpegTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ProjektGopher\FFMpegTools\FFMpegTools
 */
class FFMpegTools extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ProjektGopher\FFMpegTools\Tween::class;
    }
}
