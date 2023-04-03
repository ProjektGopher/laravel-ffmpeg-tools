<?php

namespace ProjektGopher\FFMpegTween\Utils;

/**
 * Expr
 *
 * Helps build complex expressions without worrying
 * about parentheses, line breaks, or whitespace.
 *
 * All function names and parameters are the
 * same as in the FFMpeg documentation.
 *
 * @see https://ffmpeg.org/ffmpeg-utils.html#toc-Expression-Evaluation
 */
class Expr
{
    /**
     * eq(x, y)
     *
     * Return 1 if x and y are equivalent, 0 otherwise.
     */
    public static function eq(string $x, string $y): string
    {
        return sprintf('eq(%s\\,%s)', $x, $y);
    }

    /**
     * gt(x, y)
     *
     * Return 1 if x is greater than y, 0 otherwise.
     */
    public static function gt(string $x, string $y): string
    {
        return sprintf('gt(%s\\,%s)', $x, $y);
    }

    /**
     * if(x, y, ?z)
     *
     * Evaluate x, and if the result is non-zero return the
     * evaluation result of y, otherwise the evaluation
     * result of z (or 0 if not provided).
     */
    public static function if(string $x, string $y, string $z = '0'): string
    {
        return sprintf('if(%s\\,%s\\,%s)', $x, $y, $z);
    }

    /**
     * lt(x, y)
     *
     * Return 1 if x is lesser than y, 0 otherwise.
     */
    public static function lt(string $x, string $y): string
    {
        return sprintf('lt(%s\\,%s)', $x, $y);
    }
}
