@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Update Profile</h5>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
        </ol>
    </nav>

    <div class="card card-dashboard">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-2 mb-2">

                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input name="user_name" type="text"
                                        class="form-control @error('user_name') is-invalid @enderror"
                                        value="{{ old('user_name', $user->user_name) }}" required>

                                    @error('user_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <input name="user_email" type="email"
                                        class="form-control @error('user_email') is-invalid @enderror"
                                        value="{{ old('user_email', $user->user_email) }}" required>

                                    @error('user_email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Language</label>
                                        <select name="user_language" class="form-select @error('user_language') is-invalid @enderror select-tagging">
                                            <option value="" selected disabled>Please Select</option>
                                            <option value="English" {{ old('user_language', $user->user_language ?? '') == 'English' ? 'selected' : '' }}>English</option>
                                            <option value="Malay" {{ old('user_language', $user->user_language ?? '') == 'Malay' ? 'selected' : '' }}>Malay</option>
                                            <option value="Chinese" {{ old('user_language', $user->user_language ?? '') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                            <option value="Tamil" {{ old('user_language', $user->user_language ?? '') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                                        </select>
                                    
                                        @error('user_language')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input name="" type="tel"
                                        class="form-control"
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-5 mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-main btn-lg w-100">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@include('general.profile.edit-password-card')
@endsection
