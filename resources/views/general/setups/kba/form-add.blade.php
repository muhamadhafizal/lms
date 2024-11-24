@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">New KBA Setup</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.setups.kba.index') }}">KBA Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">New KBA Setup</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route(auth()->user()->getRoles()[0].'.setups.kba.form-store') }}">
                @csrf
                <div class="row">
                    @if( auth()->user()->getRoles()[0] == 'superadmin' )
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<top class="text-danger">*</top></label>
                            <select id="client" name="client" class="form-select @error('client') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        data-companies="{{ json_encode($client->companies) }}">
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Company<top class="text-danger">*</top></label>
                            <select id="company" class="form-select @error('company') is-invalid @enderror" name="company" disabled>
                                <option value="">Please Select</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div> 
                    @else
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Company<top class="text-danger">*</top></label>
                            <select class="form-select @error('company') is-invalid @enderror" name="company">
                                <option value="">Please Select</option>
                                @foreach ( auth()->user()->companies as $company)
                                    <option value="{{$company->id}}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div> 
                    @endif

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Code<top class="text-danger">*</top></label>
                            <input name="code" type="text"
                                class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Description<top class="text-danger">*</top></label>
                            <input name="form_description" type="text"
                                class="form-control @error('form_description') is-invalid @enderror"
                                value="{{ old('form_description') }}">

                            @error('form_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Header<top class="text-danger">*</top></label>
                            <select id="header-select" name="header" class="form-select @error('header') is-invalid @enderror" required>
                                <option value="">Please Select</option>
                                <option value="3" {{ old('header') == '3' ? 'selected' : '' }}>3</option>
                                <option value="5" {{ old('header') == '5' ? 'selected' : '' }}>5</option>
                            </select>

                            @error('header')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Copy Staff Rating</label>
                            <select name="is_copy" class="form-select @error('is_copy') is-invalid @enderror">
                                <option value="0" {{ old('is_copy') == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('is_copy') == '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('is_copy')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Container to dynamically add form fields -->
                <div id="form-fields-container" class="row">
                    <!-- The form fields will be dynamically injected here -->
                </div>
                <div class="row justify-content-center mt-5 mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-main btn-lg w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include ('general.setups.kba.script-form-add')
@endsection