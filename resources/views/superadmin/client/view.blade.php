@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Client Details</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.client.index') }}">Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">Client Details</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! $client->name ?? '-' !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Registration Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ date('d-m-Y', strtotime($client->registration_date)) ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Invoice Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ date('d-m-Y', strtotime($client->invoice_date)) ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Next Renewal Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ date('d-m-Y', strtotime($client->next_renewal_date)) ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Contact</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->contact ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Fax</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->fax ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Email</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->email ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Address One</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->address_one ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Address Two</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->address_two ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Address Three</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->address_three ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Postal</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->postal ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">City</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->city ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">State</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->state ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Country</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->country ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Time Zone</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->time_zone ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">PIC Person</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->contact_person ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">PIC Contact</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->contact_tel ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">PIC Email</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->contact_email ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Logo Client</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $client->logo_file_name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main"> {!! getIsActiveStatus($client->is_active) !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Subscribed</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getClientSubscribed($client->is_subscribed) !!}</b>
                    </div>
                </div>
            </div>
            <div class="btn-custom-group">
                <a href="{{ route('superadmin.client.edit',$client) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection