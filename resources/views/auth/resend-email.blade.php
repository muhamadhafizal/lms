@extends('layouts.master.auth', [
    'title' => 'Resend Verification Email | ' . config('app.name'),
    'description' => "If you didn't get verification email, you can resend it here",
])

@section('content')
    <h1 class="title text-center text-xl-start mt-4">Resend Verification Email</h1>
    <p class="text-center text-xl-start pb-3 mb-3">Already got it? <a href="{{ route('index') }}"
            class="text-main load-spinner">Login here.</a></p>

    <form method="post" action="{{ route('resend-verification-email.submit') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control text-lowercase @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-main btn-lg w-100 mb-4">Resend</button>
    </form>
@endsection
