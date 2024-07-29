@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">New Client</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.client.index') }}">Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Client</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route('superadmin.client.store') }}">
                @csrf
                <div class="row">
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
                            <label class="form-label">PIC Person<top class="text-danger">*</top></label>
                            <input name="contact_person" type="text"
                                class="form-control @error('contact_person') is-invalid @enderror"
                                value="{{ old('contact_person') }}">

                            @error('contact_person')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">PIC Contact <top class="text-danger">*</top></label>
                            <input name="contact_tel" type="text"
                                class="form-control @error('contact_tel') is-invalid @enderror"
                                value="{{ old('contact_tel') }}">

                            @error('contact_tel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">PIC Email<top class="text-danger">*</top></label>
                            <input name="contact_email" type="email"
                                class="form-control @error('contact_email') is-invalid @enderror"
                                value="{{ old('contact_email') }}">

                            @error('contact_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Logo Client</label>
                            <input name="logo_file_name" type="file"
                                class="form-control @error('logo_file_name') is-invalid @enderror"
                                value="{{ old('logo_file_name') }}">

                            @error('logo_file_name')
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