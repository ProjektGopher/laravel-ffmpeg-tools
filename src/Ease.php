<?php

namespace ProjektGopher\FFMpegTween;

enum Ease: string
{
    case Linear = 'Linear';
    case InSine = 'EaseInSine';
    case OutSine = 'EaseOutSine';
    case InOutSine = 'EaseInOutSine';
    case InQuad = 'EaseInQuad';
    case OutQuad = 'EaseOutQuad';
    case InOutQuad = 'EaseInOutQuad';
    case InCubic = 'EaseInCubic';
    case OutCubic = 'EaseOutCubic';
    case InOutCubic = 'EaseInOutCubic';
    case InQuart = 'EaseInQuart';
    case OutQuart = 'EaseOutQuart';
    case InOutQuart = 'EaseInOutQuart';
    case InQuint = 'EaseInQuint';
    case OutQuint = 'EaseOutQuint';
    case InOutQuint = 'EaseInOutQuint';
    case InExpo = 'EaseInExpo';
    case OutExpo = 'EaseOutExpo';
    case InOutExpo = 'EaseInOutExpo';
    case InCirc = 'EaseInCirc';
    case OutCirc = 'EaseOutCirc';
    case InOutCirc = 'EaseInOutCirc';
    case InBack = 'EaseInBack';
    case OutBack = 'EaseOutBack';
    case InOutBack = 'EaseInOutBack';
    case InElastic = 'EaseInElastic';
    case OutElastic = 'EaseOutElastic';
    case InOutElastic = 'EaseInOutElastic';
    case InBounce = 'EaseInBounce';
    case OutBounce = 'EaseOutBounce';
    case InOutBounce = 'EaseInOutBounce';

    public function make(string $time): string
    {
        // Wrap the result in parentheses to ensure that it
        // doesn't interfere with surrounding expressions
        return implode([
            '(',
            EaseFunctions::{$this->value}($time),
            ')',
        ]);
    }
}
