@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Company Details</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.company.index') }}">Companies</a></li>
            <li class="breadcrumb-item active" aria-current="page">Company Details</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Client Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->client->name ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->name ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Former Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->former_name ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">ROC 1</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->roc_one ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">ROC 2</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->roc_two ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Contact</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->contact ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Fax</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->fax ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Email</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->email ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Time Zone</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->time_zone ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Registration Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ date('d-m-Y', strtotime($company->registration_date)) ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Invoice Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ date('d-m-Y', strtotime($company->invoice_date)) ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Next Renewal Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ date('d-m-Y', strtotime($company->next_renewal_date)) ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Address One</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->address_one ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Address Two</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->address_two ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Address Three</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->address_three ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Postal</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->postal ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">City</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->city ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">State</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->state ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Country</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->country ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Person Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->person_name ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Person NRIC</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->person_nric ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Person Designation</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->person_designation ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Person Email</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->person_email ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Person Contact</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $company->person_contact ?? '-' !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main"> {!! getIsActiveStatus($company->is_active) !!}</b>
                    </div>
                </div>
            </div>
            <div class="btn-custom-group">
                <a href="{{ route('superadmin.company.edit',$company) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection