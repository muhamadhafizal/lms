@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Edit Form Setup</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.appraisals.form-setups.index') }}">Form Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Form Setup</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{  route( auth()->user()->getRoles()[0]. '.appraisals.form-setups.update', $appraisalSetup) }}">
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
                                        {{ old('company', $appraisalSetup->company->id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
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
                                value="{{ old('code', $appraisalSetup->code) }}">


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
                            <input name="description" type="text"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description', $appraisalSetup->description) }}">

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Category<top class="text-danger">*</top></label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror">
                                <option value="" selected disabled>Please Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}"
                                        {{ old('category', $appraisalSetup->category) == $category->name ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Batch Setup<top class="text-danger">*</top></label>
                            <select name="batch_setup_id" class="form-select @error('batch_setup_id') is-invalid @enderror">
                                <option value="" selected disabled>Please Select</option>
                                @foreach ($batchSetups as $batchSetup)
                                    <option value="{{ $batchSetup->id }}" 
                                        {{ old('batch_setup_id', $appraisalSetup->batch_id) == $batchSetup->id ? 'selected' : '' }}>
                                        {{ $batchSetup->code }}
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_setup_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Review Start Date<top class="text-danger">*</top></label>
                            <input name="review_start_date" type="date"
                                class="form-control @error('review_start_date') is-invalid @enderror"
                                value="{{ old('review_start_date', \Carbon\Carbon::parse($appraisalSetup->review_start_date)->format('Y-m-d')) }}">

                            @error('review_start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Review End Date<top class="text-danger">*</top></label>
                            <input name="review_end_date" type="date"
                                class="form-control @error('review_end_date') is-invalid @enderror"
                                value="{{ old('review_end_date', \Carbon\Carbon::parse($appraisalSetup->review_end_date)->format('Y-m-d')) }}">

                            @error('review_end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Rating Start Date<top class="text-danger">*</top></label>
                            <input name="rating_start_date" type="date"
                                class="form-control @error('rating_start_date') is-invalid @enderror"
                                value="{{ old('rating_start_date', \Carbon\Carbon::parse($appraisalSetup->rating_start_date)->format('Y-m-d')) }}">

                            @error('rating_start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Rating End Date<top class="text-danger">*</top></label>
                            <input name="rating_end_date" type="date"
                                class="form-control @error('rating_end_date') is-invalid @enderror"
                                value="{{ old('rating_end_date', \Carbon\Carbon::parse($appraisalSetup->rating_end_date)->format('Y-m-d')) }}">

                            @error('rating_end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status <top class="text-danger">*</top></label>
                            <select name="is_active" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0"
                                    {{ old('is_active', $appraisalSetup->is_active) == '0' ? 'selected' : '' }}>
                                        Inactive</option>
                            </select>

                            @error('is_active')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5 mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-main btn-lg w-100">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include ('superadmin.employee.script')
@endsection