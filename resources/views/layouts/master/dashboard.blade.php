@extends('layouts.master.index', [
    'title' => 'Dashboard',
    'description' => '',
])

@section('meta-custom')
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
@endsection

@section('main')
    <div id="container" class="dashboard">
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-content">
                    @include('layouts.sidebar.index')
                </div>
            </nav>

            <div id="content">
                @include('layouts.navbar.index')
                <div class="overlay"></div>

                <div class="dashboard-content">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
