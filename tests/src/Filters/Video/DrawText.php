<?php

use ProjektGopher\FFMpegTools\Filters\Video\DrawText;

it('works', function () {
    expect(
        (string) DrawText::make()
            ->text('Hello World')
            ->x(10)
            ->y(10)
            ->fontSize(20)
            ->fontColor('white')
            ->box(1)
    )->toEqual("drawtext=text='Hello World':x=10:y=10:fontsize=20:fontcolor=white:box=1");
});
