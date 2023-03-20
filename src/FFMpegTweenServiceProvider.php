<?php

namespace ProjektGopher\FFMpegTween;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ProjektGopher\FFMpegTween\Commands\FFMpegTweenCommand;

class FFMpegTweenServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ffmpeg-tween')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-ffmpeg-tween_table')
            ->hasCommand(FFMpegTweenCommand::class);
    }
}
