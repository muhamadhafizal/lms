@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">New Supervisor Feedback Setup</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.setups.supervisor-feedback.index') }}">Supervisor Feedback Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Supervisor Feedback Setup</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route(auth()->user()->getRoles()[0].'.setups.supervisor-feedback.store') }}">
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
                            <label class="form-label">Description</label>
                            <input name="description" type="text"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description') }}">

                            @error('description')
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
    @include ('superadmin.employee.script')
@endsection