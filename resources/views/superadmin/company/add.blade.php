@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">New Company</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.company.index') }}">Companies</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Company</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route('superadmin.company.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client <top class="text-danger">*</top></label>
                            <select class="form-select @error('client_id') is-invalid @enderror select-tagging" name="client_id">
                                <option value="" selected disabled>Please Select</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" @if (old('client_id', '') == $client->id) selected @endif>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name<top class="text-danger">*</top></label>
                            <input name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Former Name<top class="text-danger">*</top></label>
                            <input name="former_name" type="text"
                                class="form-control @error('former_name') is-invalid @enderror"
                                value="{{ old('former_name') }}">

                            @error('former_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ROC 1<top class="text-danger">*</top></label>
                            <input name="roc_one" type="text"
                                class="form-control @error('roc_one') is-invalid @enderror"
                                value="{{ old('roc_one') }}">

                            @error('roc_one')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ROC 2<top class="text-danger">*</top></label>
                            <input name="roc_two" type="text"
                                class="form-control @error('roc_two') is-invalid @enderror"
                                value="{{ old('roc_two') }}">

                            @error('roc_two')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Contact<top class="text-danger">*</top></label>
                            <input name="contact" type="text"
                                class="form-control @error('contact') is-invalid @enderror"
                                value="{{ old('contact') }}">

                            @error('contact')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Fax</label>
                            <input name="fax" type="text"
                                class="form-control @error('fax') is-invalid @enderror"
                                value="{{ old('fax') }}">

                            @error('fax')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email<top class="text-danger">*</top></label>
                            <input name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Time Zone</label>
                            <select class="form-select @error('time_zone') is-invalid @enderror" name="time_zone">
                                <option value="Asia/Kuala Lumpur" selected>Asia/Kuala Lumpur</option>
                            </select>

                            @error('time_zone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Registration Date<top class="text-danger">*</top></label>
                            <input name="registration_date" type="date"
                                class="form-control @error('registration_date') is-invalid @enderror"
                                value="{{ old('registration_date') }}">

                            @error('registration_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Invoice Date<top class="text-danger">*</top></label>
                            <input name="invoice_date" type="date"
                                class="form-control @error('invoice_date') is-invalid @enderror"
                                value="{{ old('invoice_date') }}">

                            @error('invoice_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Renewal Date<top class="text-danger">*</top></label>
                            <input name="next_renewal_date" type="date"
                                class="form-control @error('next_renewal_date') is-invalid @enderror"
                                value="{{ old('next_renewal_date') }}">

                            @error('next_renewal_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Address One</label>
                            <input name="address_one" type="text"
                                class="form-control @error('address_one') is-invalid @enderror"
                                value="{{ old('address_one') }}">

                            @error('address_one')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Address Two</label>
                            <input name="address_two" type="text"
                                class="form-control @error('address_two') is-invalid @enderror"
                                value="{{ old('address_two') }}">

                            @error('address_two')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Address Three</label>
                            <input name="address_three" type="text"
                                class="form-control @error('address_three') is-invalid @enderror"
                                value="{{ old('address_three') }}">

                            @error('address_three')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Postal</label>
                            <input name="postal" type="text"
                                class="form-control @error('postal') is-invalid @enderror"
                                value="{{ old('postal') }}">

                            @error('postal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input name="city" type="text"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city') }}">

                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <input name="state" type="text"
                                class="form-control @error('state') is-invalid @enderror"
                                value="{{ old('state') }}">

                            @error('state')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input name="country" type="text"
                                class="form-control @error('country') is-invalid @enderror"
                                value="{{ old('country') }}">

                            @error('country')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Person Name<top class="text-danger">*</top></label>
                            <input name="person_name" type="text"
                                class="form-control @error('person_name') is-invalid @enderror"
                                value="{{ old('person_name') }}">

                            @error('person_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Person NRIC</label>
                            <input name="person_nric" type="text"
                                class="form-control @error('person_nric') is-invalid @enderror"
                                value="{{ old('person_nric') }}">

                            @error('person_nric')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Person Designation</label>
                            <input name="person_designation" type="text"
                                class="form-control @error('person_designation') is-invalid @enderror"
                                value="{{ old('person_designation') }}">

                            @error('person_designation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Person Email</label>
                            <input name="person_email" type="email"
                                class="form-control @error('person_email') is-invalid @enderror"
                                value="{{ old('person_email') }}">

                            @error('person_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Person Contact</label>
                            <input name="person_contact" type="text"
                                class="form-control @error('person_contact') is-invalid @enderror"
                                value="{{ old('person_contact') }}">

                            @error('person_contact')
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