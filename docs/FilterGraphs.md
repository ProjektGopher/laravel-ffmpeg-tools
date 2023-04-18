# Filter Graphs
A filter graph is what's used in the `-filter_complex` option of an FFMpeg command. These take in labelled audio or video streams, run a filter over them, then return newly labelled streams for further processing. As more filters are applied, these strings can become cumbersome to manage.

## Usage
When cast to a `string` either by explicitly _type hinting_ (eg. `(string) $filter_complex`), or by simply **using** it as a string (eg. `$cmd = "...{$filter_complex}";`) the `FilterGraph` class will call the `__toString()` magic method, which in turn calls the `build()` method. This makes debugging and testing easier as the `__toString` method cannot throw useful exceptions. You can **chain** the `build()` method to take advantage of this, but it's not ultimately necessary outside of testing and debugging.

```php
use ProjektGopher\FFMpegTools\Filters\FilterGraph;
use ProjektGopher\FFMpegTools\Filters\Video\VideoFilter;

$filter_complex = (string) FilterGraph::make()->addFilter(
    in: '[0:v]',
    filters: VideoFilter::drawtext()->text('Hello World'),
    out: '[vid_with_text]',
);

$cmd = "ffmpeg -y -i input.mp4 ${filter_complex} out.mp4";
```

### Instantiation
The `FilterGraph` class can be instatiated using the class constructor `(new FilterGraph)` or using the _static_ `make()` method, which simply calls the class constructor. The constructor takes no arguments, and all properties are protected. The choice here is usually just a matter of which option looks better with the way in which your command is formatted.

### Adding Filter(s)
The `addFilter()` method is really the only method you should need to use in this class. It returns `self` to allow chaining **multiple** filters. For the sake of clarity, it's recommended to use **named** arguments when calling this method. It accepts **3** arguments: a `string` representing the **named** input streams `$in` (eg: `[0:v]`, `[named_input]`); A `string`, `array`, or `Filter` object, representing the filter to be applied `$filters`; And a **nullable** `string` representing the **named** output streams `$out` (eg: `[bg_with_text]`).

Named streams should **not** be re-used. A stream should only be exported and imported **once**. This has nothing to do with this package, it's just an FFMpeg thing.

If `$filters` is passed an `array`, the `validateFilters()` method is called recursively until a final list of `strings` or `Filters` has been created. This is generally only done when very simple filters that accept/output single streams are used to avoid intermediate named outputs (eg: `[1:v] scale=-1:1080 [photo];[photo] split [photo_1][photo_2]` becomes `[1:v] scale=-1:1080, split [photo_1][photo_2]`).

This example can now be written as:
```php
$filter_complex = (string) FilterGraph::make()->addFilter(
    in: '[1:v]',
    filters: [
        'scale=-1:1080',
        'split',
    ],
    out: '[photo_1][photo_2]',
);
```

For something this simple, the `FilterGraph` class might be a bit overkill; But the more `complex` your graph becomes (pun intended), the more useful this abstraction becomes. It also just helps limit line-length in your IDE, which is always nice.

### Extending
The `FilterGraph` class is `final` and can therefor not be extended.

## Testing
###
