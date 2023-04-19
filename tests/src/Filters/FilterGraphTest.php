<?php

use ProjektGopher\FFMpegTools\Filters\FilterGraph;
use ProjektGopher\FFMpegTools\Filters\Video\VideoFilter;

it('expects a stream to be wrapped in brackets', function () {
    expect(fn () => FilterGraph::make()->validateStreams('foo'))
        ->toThrow(\Exception::class);
});

it('accepts multiple streams', function () {
    expect(FilterGraph::make()->validateStreams('[foo][1:v]'))->toEqual('[foo][1:v]');
});

it('builds a filter graph', function () {
    expect((string) FilterGraph::make()
        ->addFilter(
            in: '[0:v]',
            filters: VideoFilter::drawtext()->text('Hello World'),
            out: '[vid_with_text]',
        )
    )->toEqual("-filter_complex \"[0:v] drawtext=text='Hello World' [vid_with_text]\"");
});

it('can skip the named output stream', function () {
    expect((string) FilterGraph::make()
        ->addFilter(
            in: '[0:v]',
            filters: VideoFilter::drawtext()->text('Hello World'),
        )
    )->toEqual("-filter_complex \"[0:v] drawtext=text='Hello World'\"");
});

it('builds a filter graph with multiple string filters', function () {
    expect((string) FilterGraph::make()
        ->addFilter(
            in: '[1:v]',
            filters: [
                'scale=-1:1080',
                'split',
            ],
            out: '[photo_1][photo_2]',
        )
    )->toEqual('-filter_complex "[1:v] scale=-1:1080, split [photo_1][photo_2]"');
});
