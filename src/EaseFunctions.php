<?php

namespace ProjektGopher\FFMpegTween;

use ProjektGopher\FFMpegTween\Utils\Expr;

/**
 * Ease
 *
 * Returns a string which will evaluate to a value between 0 and 1.
 * This allows us to multiply the _change_ in value by the chosen
 * easing function to get the actual value at a given time.
 *
 * (paraphrased from easings.net)
 * The argument `$time` should be a `string` which represents the absolute
 * progress of the animation in the bounds of 0 (beginning of the animation)
 * and 1 (end of animation).
 */
class EaseFunctions
{
    public static function Linear(string $time): string
    {
        return $time;
    }

    public static function EaseInSine(string $time): string
    {
        return "1-cos((({$time})*PI)/2)";
    }

    public static function EaseOutSine(string $time): string
    {
        return "sin((({$time})*PI)/2)";
    }

    public static function EaseInOutSine(string $time): string
    {
        return "-(cos(PI*({$time}))-1)/2";
    }

    public static function EaseInQuad(string $time): string
    {
        return "pow(({$time})\\,2)";
    }

    public static function EaseOutQuad(string $time): string
    {
        return "1-(1-({$time}))*(1-({$time}))";
    }

    public static function EaseInOutQuad(string $time): string
    {
        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "2*pow(({$time})\\,2)",
            z: "1-pow(-2*({$time})+2\\,2)/2",
        );
    }

    public static function EaseInCubic(string $time): string
    {
        return "pow(({$time})\\,3)";
    }

    public static function EaseOutCubic(string $time): string
    {
        return "1-pow(1-({$time})\\,3)";
    }

    public static function EaseInOutCubic(string $time): string
    {
        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "4*pow(({$time})\\,3)",
            z: "1-pow(-2*({$time})+2\\,3)/2",
        );
    }

    public static function EaseInQuart(string $time): string
    {
        return "pow(({$time})\\,4)";
    }

    public static function EaseOutQuart(string $time): string
    {
        return "1-pow(1-({$time})\\,4)";
    }

    public static function EaseInOutQuart(string $time): string
    {
        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "8*pow(({$time})\\,4)",
            z: "1-pow(-2*({$time})+2\\,4)/2",
        );
    }

    public static function EaseInQuint(string $time): string
    {
        return "pow(({$time})\\,5)";
    }

    public static function EaseOutQuint(string $time): string
    {
        return "1-pow(1-({$time})\\,5)";
    }

    public static function EaseInOutQuint(string $time): string
    {
        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "16*pow(({$time})\\,5)",
            z: "1-pow(-2*({$time})+2\\,5)/2",
        );
    }

    public static function EaseInExpo(string $time): string
    {
        return Expr::if(
            x: Expr::eq($time, '0'),
            y: '0',
            z: "pow(2\\,10*({$time})-10)",
        );
    }

    public static function EaseOutExpo(string $time): string
    {
        return Expr::if(
            x: Expr::eq($time, '1'),
            y: '1',
            z: "1-pow(2\\,-10*({$time}))",
        );
    }

    public static function EaseInOutExpo(string $time): string
    {
        return Expr::if(
            x: Expr::eq($time, '0'),
            y: '0',
            z: Expr::if(
                x: Expr::eq($time, '1'),
                y: '1',
                z: Expr::if(
                    x: Expr::lt($time, '0.5'),
                    y: "pow(2\\,20*({$time})-10)/2",
                    z: "(2-pow(2\\,-20*({$time})+10))/2",
                ),
            ),
        );
    }

    public static function EaseInCirc(string $time): string
    {
        return "1-sqrt(1-pow(({$time})\\,2))";
    }

    public static function EaseOutCirc(string $time): string
    {
        return "sqrt(1-pow(({$time})-1\\,2))";
    }

    public static function EaseInOutCirc(string $time): string
    {
        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "(1-sqrt(1-pow(2*({$time})\\,2)))/2",
            z: "(sqrt(1-pow(-2*({$time})+2\\,2))+1)/2",
        );
    }

    public static function EaseInBack(string $time): string
    {
        $c1 = 1.70158;
        $c3 = $c1 + 1;

        return "{$c3}*pow(({$time})\\,3)-{$c1}*pow(({$time})\\,2)";
    }

    public static function EaseOutBack(string $time): string
    {
        $c1 = 1.70158;
        $c3 = $c1 + 1;

        return "1+{$c3}*pow(({$time})-1\\,3)+{$c1}*pow(({$time})-1\\,2)";
    }

    public static function EaseInOutBack(string $time): string
    {
        $c1 = 1.70158;
        $c2 = $c1 * 1.525;

        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "(pow(2*({$time})\\,2)*(({$c2}+1)*2*({$time})-{$c2}))/2",
            z: "(pow(2*({$time})-2\\,2)*(({$c2}+1)*(({$time})*2-2)+{$c2})+2)/2",
        );
    }

    public static function EaseInElastic(string $time): string
    {
        $c4 = (2 * M_PI) / 3;

        return Expr::if(
            x: Expr::eq($time, '0'),
            y: '0',
            z: Expr::if(
                x: Expr::eq($time, '1'),
                y: '1',
                z: "-pow(2\\,10*({$time})-10)*sin((({$time})*10-10.75)*{$c4})",
            ),
        );
    }

    public static function EaseOutElastic(string $time): string
    {
        $c4 = (2 * M_PI) / 3;

        return Expr::if(
            x: Expr::eq($time, '0'),
            y: '0',
            z: Expr::if(
                x: Expr::eq($time, '1'),
                y: '1',
                z: "pow(2\\,-10*({$time}))*sin((({$time})*10-0.75)*{$c4})+1",
            ),
        );
    }

    public static function EaseInOutElastic(string $time): string
    {
        $c5 = (2 * M_PI) / 4.5;

        return Expr::if(
            x: Expr::eq($time, '0'),
            y: '0',
            z: Expr::if(
                x: Expr::eq($time, '1'),
                y: '1',
                z: Expr::if(
                    x: Expr::lt($time, '0.5'),
                    y: "-(pow(2\\,20*({$time})-10)*sin((20*({$time})-11.125)*{$c5}))/2",
                    z: "(pow(2\\,-20*({$time})+10)*sin((20*({$time})-11.125)*{$c5}))/2+1",
                ),
            ),
        );
    }

    public static function EaseInBounce(string $time): string
    {
        $x = self::EaseOutBounce("1-({$time})");

        return "1-({$x})";
    }

    public static function EaseOutBounce(string $time): string
    {
        $n1 = 7.5625;
        $d1 = 2.75;
        $time2 = "(({$time})-1.5/{$d1})";
        $time3 = "(({$time})-2.25/{$d1})";
        $time4 = "(({$time})-2.65/{$d1})";

        return Expr::if(
            x: Expr::lt($time, "1/{$d1}"),
            y: "{$n1}*pow(({$time})\\,2)",
            z: Expr::if(
                x: Expr::lt($time, "2/{$d1}"),
                y: "{$n1}*{$time2}*{$time2}+0.75",
                z: Expr::if(
                    x: Expr::lt($time, "2.5/{$d1}"),
                    y: "{$n1}*{$time3}*{$time3}+0.9375",
                    z: "{$n1}*{$time4}*{$time4}+0.984375",
                ),
            ),
        );
    }

    public static function EaseInOutBounce(string $time): string
    {
        $x1 = self::EaseOutBounce("1-2*({$time})");
        $x2 = self::EaseOutBounce("2*({$time})-1");

        return Expr::if(
            x: Expr::lt($time, '0.5'),
            y: "(1-({$x1}))/2",
            z: "(1+({$x2}))/2",
        );
    }
}
