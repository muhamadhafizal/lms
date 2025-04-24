@extends('layouts.master.auth', [
    'title' => 'Sign In',
    'description' => 'Sign into your LMS account',
])

@section('content')
    <div class="mb-2">Sign into your Library Management account</div>


    @env(['staging', 'local'])
    <div class="alert alert-info">
        <div class="text-danger mb-3">For Testing Purpose Only</div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Login Account
        </button>
    </div>
    @endenv

    <form method="post" action="{{ route('login.check') }}">
        @csrf

        <div class="mb-3">
            <input name="user_email" type="email" class="form-control @error('user_email') is-invalid @enderror"
                value="{{ old('user_email') }}" placeholder="Email">

            @error('user_email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 form-password">
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password">
            <i class="bx bxs-show show-password"></i>

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <a href="" class="nav-link text-main load-spinner">Forgot your password?</a>

        <button type="submit" class="btn btn-main btn-lg w-100 mb-4">Sign In</button>
        {{-- <a href="" class="btn nav-link w-100 text-main">Resend verification
            email?</a> --}}
    </form>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="member-login load-spinner">Login as Member <i
                                    class="bx bx-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@env(['staging', 'local'])
@section('script-custom')
    <script type="module">
        $('.member-login').on('click', function() {
            $('input[name=user_email]').val('member@lms.com');
            $('input[name=password]').val('member@1234');
            $('.btn-lg').click();
        });
    </script>
@endsection
@endenv
