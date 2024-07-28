@extends('layouts.master.auth', [
    'title' => 'Sign In',
    'description' => 'Sign into your PMS account',
])

@section('content')
    <div class="mb-2">Sign into your Performance Management System account</div>
    {{-- <p class="text-center text-xl-start pb-3 mb-3">Don’t have an account yet? <a href="{{ route('register') }}"
            class="text-main">Register here.</a></p> --}}

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
                            <div class="superadmin-login load-spinner">Login as Superadmin <i
                                    class="bx bx-chevron-right"></i>
                            </div>
                            <div class="hradmin-login load-spinner">Login as HR Admin <i
                                    class="bx bx-chevron-right"></i></div>
                            <div class="supervisor-login load-spinner">Login as Supervisor <i
                                    class="bx bx-chevron-right"></i></div>
                            <div class="employee-login load-spinner">Login as Employee <i
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
        $('.superadmin-login').on('click', function() {
            $('input[name=user_email]').val('superadmin@pms.centralhr.com');
            $('input[name=password]').val('superadmin@1234');
            $('.btn-lg').click();
        });
        $('.hradmin-login').on('click', function() {
            $('input[name=user_email]').val('hradmin@pms.centralhr.com');
            $('input[name=password]').val('hradmin@1234');
            $('.btn-lg').click();
        });
        $('.supervisor-login').on('click', function() {
            $('input[name=user_email]').val('supervisor@pms.centralhr.com');
            $('input[name=password]').val('supervisor@1234');
            $('.btn-lg').click();
        });
        $('.employee-login').on('click', function() {
            $('input[name=user_email]').val('employee@pms.centralhr.com');
            $('input[name=password]').val('employee@1234');
            $('.btn-lg').click();
        });
    </script>
@endsection
@endenv
