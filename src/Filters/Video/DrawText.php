<?php

namespace ProjektGopher\FFMpegTools\Filters\Video;

use ProjektGopher\FFMpegTools\Filters\BaseFilter;

/**
 * DrawText
 *
 * The parameters for x and y are expressions containing the following constants and functions:
 *
 * dar
 * input display aspect ratio, it is the same as (w / h) * sar
 *
 * hsub
 * vsub
 * horizontal and vertical chroma subsample values. For example for the pixel format "yuv422p" hsub is 2 and vsub is 1.
 *
 * line_h, lh
 * the height of each text line
 *
 * main_h, h, H
 * the input height
 *
 * main_w, w, W
 * the input width
 *
 * max_glyph_a, ascent
 * the maximum distance from the baseline to the highest/upper grid coordinate used to place a glyph outline point, for all the rendered glyphs. It is a positive value, due to the grid’s orientation with the Y axis upwards.
 *
 * max_glyph_d, descent
 * the maximum distance from the baseline to the lowest grid coordinate used to place a glyph outline point, for all the rendered glyphs. This is a negative value, due to the grid’s orientation, with the Y axis upwards.
 *
 * max_glyph_h
 * maximum glyph height, that is the maximum height for all the glyphs contained in the rendered text, it is equivalent to ascent - descent.
 *
 * max_glyph_w
 * maximum glyph width, that is the maximum width for all the glyphs contained in the rendered text
 *
 * n
 * the number of input frame, starting from 0
 *
 * rand(min, max)
 * return a random number included between min and max
 *
 * sar
 * The input sample aspect ratio.
 *
 * t
 * timestamp expressed in seconds, NAN if the input timestamp is unknown
 *
 * text_h, th
 * the height of the rendered text
 *
 * text_w, tw
 * the width of the rendered text
 *
 * x
 * y
 * the x and y offset coordinates where the text is drawn.
 *
 * These parameters allow the x and y expressions to refer to each other, so you can for example specify y=x/dar.
 *
 * pict_type
 * A one character description of the current frame’s picture type.
 *
 * pkt_pos
 * The current packet’s position in the input file or stream (in bytes, from the start of the input). A value of -1 indicates this info is not available.
 *
 * duration
 * The current packet’s duration, in seconds.
 *
 * pkt_size
 * The current packet’s size (in bytes).
 *
 * @see https://ffmpeg.org/ffmpeg-filters.html#drawtext-1
 *
 * The drawtext video vilter accepts the following parameters:
 *
 * @method self box(int $value) Used to draw a box around text using the background color. The value must be either 1 (enable) or 0 (disable). The default value of box is 0.
 * @method self boxborderw(int $value) Set the width of the border to be drawn around the box using boxcolor. The default value of boxborderw is 0.
 * @method self boxcolor(string $value) The color to be used for drawing box around text. For the syntax of this option, check the (ffmpeg-utils)"Color" section in the ffmpeg-utils manual. The default value of boxcolor is "white".
 * @method self line_spacing(int $value) Set the line spacing in pixels of the border to be drawn around the box using box. The default value of line_spacing is 0.
 * @method self borderw(int $value) Set the width of the border to be drawn around the text using bordercolor. The default value of borderw is 0.
 * @method self bordercolor(string $value) Set the color to be used for drawing border around text. For the syntax of this option, check the (ffmpeg-utils)"Color" section in the ffmpeg-utils manual. The default value of bordercolor is "black".
 * @method self expansion(string $value) Select how the text is expanded. Can be either none, strftime (deprecated) or normal (default). See the Text expansion section below for details.
 * @method self basetime(int $value) Set a start time for the count. Value is in microseconds. Only applied in the deprecated strftime expansion mode. To emulate in normal expansion mode use the pts function, supplying the start time (in seconds) as the second argument.
 * @method self fix_bounds(bool $value) If true, check and fix text coords to avoid clipping.
 * @method self fontcolor(string $value) The color to be used for drawing fonts. For the syntax of this option, check the (ffmpeg-utils)"Color" section in the ffmpeg-utils manual. The default value of fontcolor is "black".
 * @method self fontcolor_expr(string $value) String which is expanded the same way as text to obtain dynamic fontcolor value. By default this option has empty value and is not processed. When this option is set, it overrides fontcolor option.
 * @method self font(string $value) Set the font family to be used for drawing text. By default Sans.
 * @method self fontfile(string $value) Set the font file to be used for drawing text. The path must be included. This parameter is mandatory if the fontconfig support is disabled.
 * @method self alpha(string $value) Draw the text applying alpha blending. The value can be a number between 0.0 and 1.0. The expression accepts the same variables x, y as well. The default value is 1. Please see fontcolor_expr.
 * @method self fontsize(int $value) Set the font size to be used for drawing text. The default value of fontsize is 16.
 * @method self text_shaping(int $value) If set to 1, attempt to shape the text (for example, reverse the order of right-to-left text and join Arabic characters) before drawing it. Otherwise, just draw the text exactly as given. By default 1 (if supported).
 * @method self ft_load_flags(int $value) The flags to be used for loading the fonts. The flags map the corresponding flags supported by libfreetype, and are a combination of the following values: default no_scale no_hinting render no_bitmap vertical_layout force_autohint crop_bitmap pedantic ignore_global_advance_width no_recurse ignore_transform monochrome linear_design no_autohint Default value is "default". For more information consult the documentation for the FT_LOAD_* libfreetype flags.
 * @method self shadowcolor(string $value) The color to be used for drawing a shadow behind the drawn text. For the syntax of this option, check the (ffmpeg-utils)"Color" section in the ffmpeg-utils manual. The default value of shadowcolor is "black".
 * @method self shadowx(int $value) The x and y offsets for the text shadow position with respect to the position of the text. They can be either positive or negative values. The default value for both is "0".
 * @method self shadowy(int $value) The x and y offsets for the text shadow position with respect to the position of the text. They can be either positive or negative values. The default value for both is "0".
 * @method self start_number(int $value) The starting frame number for the n/frame_num variable. The default value is "0".
 * @method self tabsize(int $value) The size in number of spaces to use for rendering the tab. Default value is 4.
 * @method self timecode(string $value) Set the initial timecode representation in "hh:mm:ss[:;.]ff" format. It can be used with or without text parameter. timecode_rate option must be specified.
 * @method self timecode_rate(int $value) Set the timecode frame rate (timecode only). Value will be rounded to nearest integer. Minimum value is "1". Drop-frame timecode is supported for frame rates 30 & 60.
 * @method self rate(int $value) alias of timecode_rate
 * @method self r(int $value) alias of timecode_rate
 * @method self tc24hmax(int $value) If set to 1, the output of the timecode option will wrap around at 24 hours. Default is 0 (disabled).
 * @method self text(string $value) The text string to be drawn. The text must be a sequence of UTF-8 encoded characters. This parameter is mandatory if no file is specified with the parameter textfile.
 * @method self textfile(string $value) A text file containing text to be drawn. The text must be a sequence of UTF-8 encoded characters. This parameter is mandatory if no text string is specified with the parameter text. If both text and textfile are specified, an error is thrown.
 * @method self text_source(string $value) Text source should be set as side_data_detection_bboxes if you want to use text data in detection bboxes of side data. If text source is set, text and textfile will be ignored and still use text data in detection bboxes of side data. So please do not use this parameter if you are not sure about the text source.
 * @method self reload(int $value) The textfile will be reloaded at specified frame interval. Be sure to update textfile atomically, or it may be read partially, or even fail. Range is 0 to INT_MAX. Default is 0.
 * @method self x(string $value) The expressions which specify the offsets where text will be drawn within the video frame. They are relative to the top/left border of the output image. The default value of x and y is "0".
 * @method self y(string $value) The expressions which specify the offsets where text will be drawn within the video frame. They are relative to the top/left border of the output image. The default value of x and y is "0".
 */
final class DrawText extends BaseFilter
{
    protected string $filter_name = 'drawtext';

    public function box(int $value): self
    {
        $this->properties['box'] = $value;

        return $this;
    }

    public function boxborderw(int $value): self
    {
        $this->properties['boxborderw'] = $value;

        return $this;
    }

    public function boxcolor(string $value): self
    {
        $this->properties['boxcolor'] = $value;

        return $this;
    }

    public function line_spacing(int $value): self
    {
        $this->properties['line_spacing'] = $value;

        return $this;
    }

    public function borderw(int $value): self
    {
        $this->properties['borderw'] = $value;

        return $this;
    }

    public function bordercolor(string $value): self
    {
        $this->properties['bordercolor'] = $value;

        return $this;
    }

    public function expansion(string $value): self
    {
        $this->properties['expansion'] = $value;

        return $this;
    }

    public function basetime(int $value): self
    {
        $this->properties['basetime'] = $value;

        return $this;
    }

    public function fix_bounds(bool $value): self
    {
        $this->properties['fix_bounds'] = (int) $value;

        return $this;
    }

    public function fontcolor(string $value): self
    {
        $this->properties['fontcolor'] = $value;

        return $this;
    }

    public function fontcolor_expr(string $value): self
    {
        $this->properties['fontcolor_expr'] = $value;

        return $this;
    }

    public function font(string $value): self
    {
        $this->properties['font'] = $value;

        return $this;
    }

    public function fontfile(string $value): self
    {
        $this->properties['fontfile'] = $value;

        return $this;
    }

    public function alpha(string $value): self
    {
        $this->properties['alpha'] = $value;

        return $this;
    }

    public function fontsize(int $value): self
    {
        $this->properties['fontsize'] = $value;

        return $this;
    }

    public function text_shaping(int $value): self
    {
        $this->properties['text_shaping'] = $value;

        return $this;
    }

    public function ft_load_flags(int $value): self
    {
        $this->properties['ft_load_flags'] = $value;

        return $this;
    }

    public function shadowcolor(string $value): self
    {
        $this->properties['shadowcolor'] = $value;

        return $this;
    }

    public function shadowx(int $value): self
    {
        $this->properties['shadowx'] = $value;

        return $this;
    }

    public function shadowy(int $value): self
    {
        $this->properties['shadowy'] = $value;

        return $this;
    }

    public function start_number(int $value): self
    {
        $this->properties['start_number'] = $value;

        return $this;
    }

    public function tabsize(int $value): self
    {
        $this->properties['tabsize'] = $value;

        return $this;
    }

    public function timecode(string $value): self
    {
        $this->properties['timecode'] = $value;

        return $this;
    }

    public function timecode_rate(int $value): self
    {
        $this->properties['timecode_rate'] = $value;

        return $this;
    }

    public function rate(int $value): self
    {
        return $this->timecode_rate($value);
    }

    public function r(int $value): self
    {
        return $this->timecode_rate($value);
    }

    public function tc24hmax(int $value): self
    {
        $this->properties['tc24hmax'] = $value;

        return $this;
    }

    public function text(string $value): self
    {
        $this->properties['text'] = $value;

        return $this;
    }

    public function textfile(string $value): self
    {
        $this->properties['textfile'] = $value;

        return $this;
    }

    public function text_source(string $value): self
    {
        $this->properties['text_source'] = $value;

        return $this;
    }

    public function reload(int $value): self
    {
        $this->properties['reload'] = $value;

        return $this;
    }

    public function x(string $value): self
    {
        $this->properties['x'] = $value;

        return $this;
    }

    public function y(string $value): self
    {
        $this->properties['y'] = $value;

        return $this;
    }
}
