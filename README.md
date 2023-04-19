# Tools and utilities to help generate complex strings for FFMpeg in Laravel.
[![Latest Version on Packagist](https://img.shields.io/packagist/v/projektgopher/laravel-ffmpeg-tools.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-ffmpeg-tools)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/projektgopher/laravel-ffmpeg-tools/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/projektgopher/laravel-ffmpeg-tools/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/projektgopher/laravel-ffmpeg-tools/phpstan.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/projektgopher/laravel-ffmpeg-tools/actions?query=workflow%3A"phpstan"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/projektgopher/laravel-ffmpeg-tools.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-ffmpeg-tools)

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
composer require projektgopher/laravel-ffmpeg-tools
```

## Usage
 - [Easing](docs/Easing.md)
 - [Expressions](docs/Expressions.md)
 - [Filters](docs/Filters.md)
 - [Filter Graphs](docs/FilterGraphs.md)
 - [Timelines and Keyframes](docs/Timelines.md)
 - [Tweening](docs/Tweening.md)

### Using outside of a Laravel application
For now this package can only be used within a Laravel app, but there are plans to extract the core functionality into a separate package that can be used without being bound to the framework.

## Testing
 - [Instructions](docs/Testing.md)

## Changelog
Please see [RELEASES](releases) for more information on what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities
Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits
A **big** "Thank You" to [EXACTsports](https://github.com/EXACTsports) for supporting the development of this package.

- [Len Woodward](https://github.com/ProjektGopher)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
