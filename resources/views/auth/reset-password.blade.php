@extends('layouts.master.auth', [
    'title' => 'Reset Password | ' . config('app.name'),
    'description' => 'Reset your AODS account password',
])

@section('meta-custom')
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
@endsection

@section('content')
    <div class="mb-2">Reset your AODS account password</div>

    <form method="post" action="{{ route('reset-password.submit', $token) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input name="confirm_password" type="password"
                class="form-control @error('confirm_password') is-invalid @enderror" required>

            @error('confirm_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <a href="{{ route('index') }}" class="nav-link text-main load-spinner">Back to Sign In</a>

        <div align="center" class="my-4">
            {!! htmlFormSnippet() !!}

            @error('g-recaptcha-response')
                <div class="text-danger text-center">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-main btn-lg w-100 mb-4">Reset now</button>
    </form>
@endsection
