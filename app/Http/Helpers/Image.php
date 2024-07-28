<?php

use Illuminate\Support\Facades\App;

if (! function_exists('app_asset')) {
    function app_asset(string $path): string
    {
        // if (App::environment('staging') || App::environment('local')) {
        //     $baseUrl = env('PROD_URL', 'https://coolcode.my');

        //     return rtrim($baseUrl, '/').'/'.ltrim($path, '/');
        // }

        return asset($path);
    }
}
