@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">New Employee</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.employee.index') }}">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Employee</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route('hradmin.employee.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name<top class="text-danger">*</top></label>
                            <input name="user_name" type="text"
                                class="form-control @error('user_name') is-invalid @enderror"
                                value="{{ old('user_name') }}">

                            @error('user_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email<top class="text-danger">*</top></label>
                            <input name="user_email" type="email"
                                class="form-control @error('user_email') is-invalid @enderror"
                                value="{{ old('user_email') }}">

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
                            <select name="user_language" class="form-select @error('user_language') is-invalid @enderror">
                                <option value="" selected disabled>Please Select</option>
                                <option value="English" {{ old('user_language') == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Malay" {{ old('user_language') == 'Malay' ? 'selected' : '' }}>Malay</option>
                                <option value="Chinese" {{ old('user_language') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                <option value="Tamil" {{ old('user_language') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                            </select>

                            @error('user_language')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>   
                    <hr>         
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Role<top class="text-danger">*</top></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role') == $role->id ? 'selected' : '' }}>
                                        {{ $role->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5 mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-main btn-lg w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection