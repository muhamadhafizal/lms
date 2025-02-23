@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Details Form</h5>
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->getRoles()[0]. '.appraisals.index') }}">Form</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details Form</li>
        </ol>
    </nav>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            <div class="container">
                <div class="row align-items-center mb-4">
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">Part Title</th>
                                    <th class="text-center">Weightage</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appraisalParts as $key =>$appraisalPart)
                                    <tr>
                                        <td class="text-center">
                                            {{ $appraisalPart->related_model?->{$appraisalPart->model === 'KRA' ? 'name' : 'code'} ?? $appraisalPart->model }}
                                        </td>
                                        <td class="text-center">{{ $appraisalPart->title }}</td>
                                        <td class="text-center">{{ $appraisalPart->weightage }}%</td>
                                        <td class="text-center">
                                            <a href=""
                                            class="btn btn-outline-main" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="View Form"><i
                                                class="bx bxs-show"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">Employee Feedback</td>
                                    <td class="text-center">{{ $employeeFeedback->description }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">
                                            <a href=""
                                            class="btn btn-outline-main" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="View Form"><i
                                                class="bx bxs-show"></i></a>
                                        </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Supervisor Feedback</td>
                                    <td class="text-center">{{ $supervisorFeedback->description }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">
                                            <a href=""
                                            class="btn btn-outline-main" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="View Form"><i
                                                class="bx bxs-show"></i></a>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection