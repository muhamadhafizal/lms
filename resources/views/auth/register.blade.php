@extends('layouts.master.auth', [
    'title' => 'Register | ' . config('app.name'),
    'description' => 'Register a new account with Far East Bunkering Services now',
])

@section('content')
    <h1 class="title text-center text-xl-start mt-4">Create Account</h1>
    <p class="text-center text-xl-start pb-3 mb-3">Already have an account? <a href="{{ route('index') }}"
            class="text-main load-spinner">Login here.</a></p>

    <form method="post" action="{{ route('register.save') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

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

        <div class="mb-3 form-password">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
            <i class="bx bxs-show show-password"></i>

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <div>
                By signing up, I agree to <a href="{{ route('terms') }}" class="text-main">Terms of Services</a>
                provided by {{ config('app.name') }}
            </div>
        </div>

        <button type="submit" class="btn btn-main btn-lg w-100 mb-4">Register</button>
    </form>
@endsection
