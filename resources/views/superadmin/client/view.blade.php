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
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <tr>
                        <td>Name</td>
                        <td><b class="text-main">{!! $client->name ?? '-' !!}</b></td>
                    </tr>
                    <tr>
                        <td>Registration Date</td>
                        <td><b class="text-main">{{ date('d-m-Y', strtotime($client->registration_date)) ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td><b class="text-main">{{ date('d-m-Y', strtotime($client->invoice_date)) ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Next Renewal Date</td>
                        <td><b class="text-main">{{ date('d-m-Y', strtotime($client->next_renewal_date)) ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><b class="text-main">{{ $client->contact ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td><b class="text-main">{{ $client->fax ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><b class="text-main">{{ $client->email ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Address One</td>
                        <td><b class="text-main">{{ $client->address_one ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Two</td>
                        <td><b class="text-main">{{ $client->address_two ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Three</td>
                        <td><b class="text-main">{{ $client->address_three ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Postal</td>
                        <td><b class="text-main">{{ $client->postal ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><b class="text-main">{{ $client->city ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><b class="text-main">{{ $client->state ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><b class="text-main">{{ $client->country ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Time Zone</td>
                        <td><b class="text-main">{{ $client->time_zone ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>PIC Person</td>
                        <td><b class="text-main">{{ $client->contact_person ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>PIC Contact</td>
                        <td><b class="text-main">{{ $client->contact_tel ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>PIC Email</td>
                        <td><b class="text-main">{{ $client->contact_email ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Logo Client</td>
                        <td><b class="text-main">{{ $client->logo_file_name ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><b class="text-main"> {!! getIsActiveStatus($client->is_active) !!}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Subscribed</td>
                        <td><b class="text-main">{!! getClientSubscribed($client->is_subscribed) !!}</b>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="btn-custom-group">
                <a href="{{ route('superadmin.client.edit',$client) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection