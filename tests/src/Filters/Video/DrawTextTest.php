<?php

use ProjektGopher\FFMpegTools\Filters\Video\VideoFilter;

it('works', function () {
    expect(
        (string) VideoFilter::drawtext()
            ->text('Hello World')
            ->x(10)
            ->y(10)
            ->fontsize(20)
            ->fontcolor('white')
            ->box(1)
    )->toEqual("drawtext=text='Hello World':x=10:y=10:fontsize=20:fontcolor=white:box=1");
});
