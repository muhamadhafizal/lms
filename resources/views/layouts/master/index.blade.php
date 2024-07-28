<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? 'Living Big In Small Space' }}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $title ?? config('app.name') }}">
    <meta itemprop="description" content="{{ $description ?? 'Living Big In Small Space' }}">
    <meta itemprop="image" content="{{ $image ?? app_asset('images/banner.jpg') }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $description ?? 'Living Big In Small Space' }}">
    <meta property="og:image" content="{{ $image ?? app_asset('images/banner.jpg') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $description ?? 'Living Big In Small Space' }}">
    <meta name="twitter:image" content="{{ $image ?? app_asset('images/banner.jpg') }}">

    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{ app_asset('images/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ app_asset('images/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ app_asset('images/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ app_asset('images/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="{{ app_asset('images/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ app_asset('images/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="{{ app_asset('images/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ app_asset('images/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ app_asset('images/favicon/favicon-196x196.png') }}"
        sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ app_asset('images/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ app_asset('images/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ app_asset('images/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ app_asset('images/favicon/favicon-128.png') }}" sizes="128x128" />
    <meta name="msapplication-TileImage" content="{{ app_asset('images/favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ app_asset('images/favicon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ app_asset('images/favicon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ app_asset('images/favicon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ app_asset('images/favicon/mstile-310x310.png') }}" />

    @env(['staging', 'local'])
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    @endenv

    @env(['production'])
    @yield('meta-custom')
    @endenv

    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    @yield('style-custom')
</head>

<body>
    <div class="spinner-content">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <h5>Loading..</h5>
    </div>

    @yield('main')

    @yield('script-custom')

    @include('errors.messages')

    <div class="modal fade modal-img" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="bx bx-x"></i></button>
                    <img src="" class="img-fluid img-src" alt="Image" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
