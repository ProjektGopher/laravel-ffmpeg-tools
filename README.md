# Generate FFMpeg easing and tweening strings in Laravel.
[![Latest Version on Packagist](https://img.shields.io/packagist/v/projektgopher/laravel-ffmpeg-tween.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-ffmpeg-tween)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/projektgopher/laravel-ffmpeg-tween/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/projektgopher/laravel-ffmpeg-tween/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/projektgopher/laravel-ffmpeg-tween/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/projektgopher/laravel-ffmpeg-tween/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/projektgopher/laravel-ffmpeg-tween.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-ffmpeg-tween)

FFMpeg can be opaque in its commands. Take the following example:
```bash
if(lt(t\,5)\,((w*7/8)-text_w-200)\,if(gt(t\,5+2)\,((w*7/8)-text_w)\,((w*7/8)-text_w-200)+((((w*7/8)-text_w)-((w*7/8)-text_w-200))(if(eq(((t-5)/2)\,0)\,0\,if(eq(((t-5)/2)\,1)\,1\,pow(2\,-10((t-5)/2))*sin((((t-5)/2)*10-0.75)*2.0943951023932)+1))))))
```
This **completely bonkers** string will calculate _just_ the `x` position of a text element. It'll wait 5 seconds, animate the element from 200px left of its final position over 2 seconds with an easing of `EaseOutElastic`. How would you approach changing this to an easing of `EaseOutBounce`? Not gonna happen.

This package allows you to build these string in a fluent way that's easily maintainable in a way that feels familiar to php and Laravel devs. The following example will output the exact same string as above, but imagine how much easier it'll be to change:
```php
$finalXpos = '(w*7/8)-text_w';
$x = (new Tween())
    ->from("{$finalXpos}-200")
    ->to($finalXpos)
    ->delay(Timing::seconds(5))
    ->duration(Timing::seconds(2))
    ->ease(Ease::OutElastic);
```

The API is modelled after [The GreenSock Animation Platform (GSAP)](https://greensock.com/get-started/#whatIsGSAP)
and all the math for the easings is ported from [Easings.net](https://easings.net).
The stringification of these math strings is ported from [This Gitlab repo](https://gitlab.com/dak425/easing/-/blob/master/ffmpeg/ffmpeg.go)

## Installation
You can install the package via composer:
```bash
composer require projektgopher/laravel-ffmpeg-tween
```

## Usage
### Using outside of a Laravel application
For now this package can only be used within a Laravel app, but there are plans to extract the core functionality into a separate package that can be used without being bound to the framework.

### Simple tween with delay and duration
```php
use ProjektGopher\FFMpegTween\Tween;
use ProjektGopher\FFMpegTween\Timing;
use ProjektGopher\FFMpegTween\Enums\Ease;

$x = (new Tween())
    ->from("50")
    ->to("100")
    ->delay(Timing::seconds(1))
    ->duration(Timing::milliseconds(300))
    ->ease(Ease::OutSine);
```

### Animation sequences using keyframes
```php
use ProjektGopher\FFMpegTween\Keyframe;
use ProjektGopher\FFMpegTween\Timeline;
use ProjektGopher\FFMpegTween\Timing;
use ProjektGopher\FFMpegTween\Enums\Ease;

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

## Testing
```bash
composer test
```

### Visual Snapshot Testing
#### Easing
To generate plots of all `Ease` methods, from the project root, run
```bash
./scripts/generateEasings
```
The 256x256 PNGs will be generated in the `tests/Snapshots/Easings` directory.
These snapshots will be ignored by git, but allow visual inspection of the plots to
compare against known good sources, like [Easings.net](https://easings.net).

#### Timelines
To generate a video using a `Timeline` with `Keyframes`, from the project root, run
```bash
./scripts/generateTimeline
```
The 256x256 MP4 will be generated in the `tests/Snapshots/Timelines` directory.
These snapshots will also be ignored by git, but again allow for a visual
inspection to ensure they match the expected output.

> **Note** The `scripts` directory _may_ need to have its permissions changed to allow script execution
```bash
chmod -R 777 ./scripts
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities
Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits
- [Len Woodward](https://github.com/ProjektGopher)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
