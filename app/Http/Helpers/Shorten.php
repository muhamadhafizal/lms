<?php

if (! function_exists('getShortName')) {
    function getShortName(string $name = '-'): string
    {
        if (strlen($name) > 10) {
            $name = substr($name, 0, 10).'..';
        }

        return $name;
    }
}

if (! function_exists('getShortName2')) {
    function getShortName2(string $name = '-'): string
    {
        if (strlen($name) > 20) {
            $name = substr($name, 0, 20).'..';
        }

        return $name;
    }
}

if (! function_exists('getShortText')) {
    function getShortText(string $text): string
    {
        if (strlen($text) > 100) {
            $text = substr($text, 0, 100).'...';
        }

        return $text;
    }
}
