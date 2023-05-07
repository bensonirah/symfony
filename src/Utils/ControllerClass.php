<?php

namespace Arch\Utils;

class ControllerClass
{
    public static function name(object $instance): string
    {
        return pathinfo(
            basename(self::path($instance)),
            PATHINFO_FILENAME
        );
    }

    public static function path(object $instance): string
    {
        return join('', [str_replace(['\\', 'Arch'], ['/', 'src'], basename(get_class($instance))), '.php']);
    }
}