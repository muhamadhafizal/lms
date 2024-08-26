@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Profile</h5>
        </ol>
    </nav>

    <div class="card card-dashboard card-profile">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover">
                            <tr>
                                <td>Name</td>
                                <td><b class="text-main">{{ $user->user_name ?? '-' }}</b></td>
                            </tr>
                            <tr>
                                <td>Roles</td>
                                <td><b class="text-main"> {!! getRoleBadge(auth()->user()->getRoles()[0])!!}</b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><b class="text-main">{{ $user->user_email ?? '-' }}</b></td>
                            </tr>
                            <tr>
                                <td>Language</td>
                                <td><b class="text-main">{{ $user->user_language ?? '-' }}</b></td>
                            </tr>
                            <tr>
                                <td>Registered On</td>
                                <td>
                                    <b class="text-main">
                                        {{ date('d-m-Y g:i:s A', strtotime($user->created_at)) ?? '-' }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>Last Updated On</td>
                                <td>
                                    <b class="text-main">
                                        {{ date('d-m-Y g:i:s A', strtotime($user->updated_at)) ?? '-' }}
                                    </b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-md-5 mb-3">
                <div class="col-md-4">
                    <a href="{{ route('profile.edit') }}" class="btn btn-main btn-lg w-100 load-spinner">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
