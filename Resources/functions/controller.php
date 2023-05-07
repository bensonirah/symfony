<?php


use Arch\Utils\ControllerClass;

if (!function_exists('controller')) {
    function controller(object $instance): string
    {
        return ControllerClass::path($instance);
    }
}


if (!function_exists('controller_name')) {
    function controller_name(object $instance): string
    {
        return ControllerClass::name($instance);
    }
}




