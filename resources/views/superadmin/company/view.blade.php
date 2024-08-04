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
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <tr>
                        <td>company Name</td>
                        <td><b class="text-main">{!! $company->client->name ?? '-' !!}</b></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><b class="text-main">{!! $company->name ?? '-' !!}</b></td>
                    </tr>
                    <tr>
                        <td>Former Name</td>
                        <td><b class="text-main">{!! $company->former_name ?? '-' !!}</b></td>
                    </tr>
                    <tr>
                        <td>ROC 1</td>
                        <td><b class="text-main">{!! $company->roc_one ?? '-' !!}</b></td>
                    </tr>
                    <tr>
                        <td>ROC 2</td>
                        <td><b class="text-main">{!! $company->roc_two ?? '-' !!}</b></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><b class="text-main">{{ $company->contact ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td><b class="text-main">{{ $company->fax ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><b class="text-main">{{ $company->email ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Time Zone</td>
                        <td><b class="text-main">{{ $company->time_zone ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Registration Date</td>
                        <td><b class="text-main">{{ date('d-m-Y', strtotime($company->registration_date)) ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td><b class="text-main">{{ date('d-m-Y', strtotime($company->invoice_date)) ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Next Renewal Date</td>
                        <td><b class="text-main">{{ date('d-m-Y', strtotime($company->next_renewal_date)) ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Address One</td>
                        <td><b class="text-main">{{ $company->address_one ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Two</td>
                        <td><b class="text-main">{{ $company->address_two ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Three</td>
                        <td><b class="text-main">{{ $company->address_three ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Postal</td>
                        <td><b class="text-main">{{ $company->postal ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><b class="text-main">{{ $company->city ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><b class="text-main">{{ $company->state ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><b class="text-main">{{ $company->country ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Person Name</td>
                        <td><b class="text-main">{{ $company->person_name ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Person NRIC</td>
                        <td><b class="text-main">{{ $company->person_nric ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Person Designation</td>
                        <td><b class="text-main">{{ $company->person_designation ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Person Email</td>
                        <td><b class="text-main">{{ $company->person_email ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Person Contact</td>
                        <td><b class="text-main">{{ $company->person_contact ?? '-' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><b class="text-main"> {!! getIsActiveStatus($company->is_active) !!}</b>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="btn-custom-group">
                <a href="{{ route('superadmin.company.edit',$company) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection