<?php

namespace ProjektGopher\FFMpegTween\Commands;

use Illuminate\Console\Command;

class FFMpegTweenCommand extends Command
{
    public $signature = 'laravel-ffmpeg-tween';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
