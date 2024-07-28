@extends('layouts.master.auth', [
    'title' => 'Forgot Password | ' . config('app.name'),
    'description' => 'Request to reset your AODS account password',
])

@section('content')
    <div class="mb-2">Request to reset your AODS account password</div>

    <form method="post" action="{{ route('forgot-password.submit') }}">
        @csrf

        <div class="mb-3">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Email" required>

            @error('email')
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

        <button type="submit" class="btn btn-main btn-lg w-100 mb-4">Submit</button>
    </form>
@endsection
