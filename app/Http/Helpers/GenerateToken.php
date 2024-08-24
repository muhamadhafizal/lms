<?php

if (! function_exists('generateToken')) {
    function generateToken(int $length): string
    {
        return bin2hex(random_bytes($length));
    }
}
