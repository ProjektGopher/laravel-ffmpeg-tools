# Timelines and Keyframes

## Animation sequences using keyframes
```php
use ProjektGopher\FFMpegTools\Keyframe;
use ProjektGopher\FFMpegTools\Timeline;
use ProjektGopher\FFMpegTools\Timing;
use ProjektGopher\FFMpegTools\Ease;

$x = new Timeline()
$x->keyframe((new Keyframe)
    ->value('-text_w') // outside left of frame
    ->hold(Timing::seconds(1))
);
$x->keyframe((new Keyframe)
    ->value('(main_w/2)-(text_w/2)') // center
    ->ease(Ease::OutElastic)
    ->duration(Timing::seconds(1))
    ->hold(Timing::seconds(3))
);
$x->keyframe((new Keyframe)
    ->value('main_w') // outside right of frame
    ->ease(Ease::InBack)
    ->duration(Timing::seconds(1))
);
```

> **Note** `new Timeline()` returns a _fluent_ api, meaning methods can be chained as well.
