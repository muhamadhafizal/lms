@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Edit KBA Setup</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.setups.kba.index') }}">KBA Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit KBA Setup</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{  route(auth()->user()->getRoles()[0].'.setups.kba.form-update', $kbaForm) }}">
                @csrf
                <div class="row">
                    @if(auth()->user()->getRoles()[0] == 'superadmin')
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<top class="text-danger">*</top></label>
                            <select id="client" name="client" class="form-select @error('client') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        data-companies="{{ json_encode($client->companies) }}"
                                        {{ old('client', auth()->user()->companies->first()->client->id) == $client->id ? 'selected' : '' }}>
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
                            <select id="company" class="form-select @error('company') is-invalid @enderror" name="company">
                                <option value="">Please Select</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company', auth()->user()->companies->first()->id) == $company->id ? 'selected' : '' }}>
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
                                    <option value="{{$company->id}}"
                                        {{ old('company', $kbaForm->company->id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
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
                                value="{{ old('code', $kbaForm->code) }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input name="form_description" type="text"
                                class="form-control @error('form_description') is-invalid @enderror"
                                value="{{ old('form_description', $kbaForm->description) }}">

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
                            <input name="header" type="text"
                                class="form-control @error('header') is-invalid @enderror"
                                value="{{ old('header', $kbaHeader->header ?? '-') }}" required readonly>

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
                                <option value="0" {{ old('is_copy', $kbaForm->copy_staff_rating) == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('is_copy', $kbaForm->copy_staff_rating) == '1' ? 'selected' : '' }}>Yes</option>
                            </select>


                            @error('is_copy')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status <top class="text-danger">*</top></label>
                            <select name="active" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0"
                                    {{ old('active', $kbaForm->is_active) == '0' ? 'selected' : '' }}>
                                        Inactive</option>
                            </select>

                            @error('active')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <hr>
                <!-- Container to dynamically add form fields -->
                @foreach($kbaHeader->KBADescriptionSetups as $index => $descriptionSetup)
                    <div class="row">
                    <input type="hidden" name="kba_desc_setup_id[]" value="{{ $descriptionSetup->id }}">
                        <div class="col-md-2">
                            <label class="form-label">No</label>
                            <input type="text" class="form-control" name="no[]" value="{{ $descriptionSetup->no }}" readonly required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Legend</label>
                            <input type="text" class="form-control" name="legend[]" value="{{ $descriptionSetup->legend }}" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description[]" value="{{ $descriptionSetup->description }}" required>
                        </div>
                    </div>
                @endforeach
                <div class="row justify-content-center mt-5 mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-main btn-lg w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include ('superadmin.employee.script')
@endsection