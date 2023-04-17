<?php

use ProjektGopher\FFMpegTools\Filters\FilterGraph;
use ProjektGopher\FFMpegTools\Filters\Video\VideoFilter;

it('builds a filter graph', function () {
    expect((string) FilterGraph::make()
        ->addFilter(
            in: '[0:v]',
            filters: [
                VideoFilter::drawtext()->text('Hello World'),
            ],
            out: '[vid_with_text]',
        )
    )->toEqual("-filter_complex \"[0:v] drawtext=text='Hello World' [vid_with_text]\"");
});
