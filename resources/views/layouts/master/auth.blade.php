@extends('layouts.master.index')

@section('meta-custom')
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
@endsection

@section('main')
    <div class="auth-page">
        <div class="row auth-content">
            <div class="col-md-4 bg-content">
               
            </div>

            <div class="col-md-8">
                <div class="container">
                    <div class="content">
                        <div class="card">
                            <div class="card-body">
                                <i class="bx bx-place"></i>
                                <img src="{{ asset('images/centralhrthree.png') }}" class="img-fluid mb-3" alt="Logo" loading="lazy">
                                @yield ('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection