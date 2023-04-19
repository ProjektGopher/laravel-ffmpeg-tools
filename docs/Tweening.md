# Tweening

## Simple tween with delay and duration
```php
use ProjektGopher\FFMpegTools\Tween;
use ProjektGopher\FFMpegTools\Timing;
use ProjektGopher\FFMpegTools\Ease;

$x = (new Tween())
    ->from("50")
    ->to("100")
    ->delay(Timing::seconds(1))
    ->duration(Timing::milliseconds(300))
    ->ease(Ease::OutSine);
```
