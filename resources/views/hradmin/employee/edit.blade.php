@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Edit Employee</h5>
            <li class="breadcrumb-item"><a href="{{ route('hradmin.employee.index') }}">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route('hradmin.employee.update', $employee->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name<top class="text-danger">*</top></label>
                            <input name="user_name" type="text"
                                class="form-control @error('user_name') is-invalid @enderror"
                                value="{{ old('user_name', $employee->user_name) }}">

                            @error('user_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email<top class="text-danger">*</top></label>
                            <input name="user_email" type="email"
                                class="form-control @error('user_email') is-invalid @enderror"
                                value="{{ old('user_email', $employee->user_email) }}">

                            @error('user_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Role<top class="text-danger">*</top></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role', $employee->roles[0]->id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Supervisor 1</label>
                            <select name="supervisor_one" class="form-select @error('supervisor_one') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}"
                                        {{ old('supervisor_one', optional($employee->employee->supervisors->firstWhere('level', 1))->supervisor_id) == $supervisor->id ? 'selected' : '' }}>
                                        {{ $supervisor->user_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('supervisor_one')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Supervisor 2</label>
                            <select name="supervisor_two" class="form-select @error('supervisor_two') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}"
                                        {{ old('supervisor_two', optional($employee->employee->supervisors->firstWhere('level', 2))->supervisor_id) == $supervisor->id ? 'selected' : '' }}>
                                        {{ $supervisor->user_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('supervisor_two')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>  
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Security Group</label>
                            <select name="securityGroup" class="form-select @error('securityGroup') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['securityGroups'] as $securityGroup)
                                    <option value="{{ $securityGroup->id }}"
                                        {{ old('securityGroup', optional(optional($employee->employee)->securityGroup)->id) == $securityGroup->id ? 'selected' : '' }}>
                                        {{ $securityGroup->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('securityGroup')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>       
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Language</label>
                            <select name="user_language" class="form-select @error('user_language') is-invalid @enderror">
                                <option value="" disabled>Please Select</option>
                                <option value="English" {{ old('user_language', $employee->user_language) == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Malay" {{ old('user_language', $employee->user_language) == 'Malay' ? 'selected' : '' }}>Malay</option>
                                <option value="Chinese" {{ old('user_language', $employee->user_language) == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                <option value="Tamil" {{ old('user_language', $employee->user_language) == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                            </select>

                            @error('user_language')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Race</label>
                            <select name="race" class="form-select @error('race') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['races'] as $race)
                                    <option value="{{ $race->id }}"
                                        {{ old('race', optional(optional($employee->employee)->race)->id) == $race->id ? 'selected' : '' }}>
                                        {{ $race->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('race')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Religion</label>
                            <select name="religion" class="form-select @error('religion') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['religions'] as $religion)
                                    <option value="{{ $religion->id }}"
                                        {{ old('religion', optional(optional($employee->employee)->religion)->id) == $religion->id ? 'selected' : '' }}>
                                        {{ $religion->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('religion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Nationality</label>
                            <select name="nationality" class="form-select @error('nationality') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['nationalities'] as $nationality)
                                    <option value="{{ $nationality->id }}"
                                        {{ old('nationality', optional(optional($employee->employee)->nationality)->id) == $nationality->id ? 'selected' : '' }}>
                                        {{ $nationality->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('nationality')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Work Location</label>
                            <select name="workLocation" class="form-select @error('workLocation') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['workLocations'] as $workLocation)
                                    <option value="{{ $workLocation->id }}"
                                        {{ old('workLocation', optional(optional($employee->employee)->workLocation)->id) == $workLocation->id ? 'selected' : '' }}>
                                        {{ $workLocation->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('workLocation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Cost Centre</label>
                            <select name="costCentre" class="form-select @error('costCentre') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['costCentres'] as $costCentre)
                                    <option value="{{ $costCentre->id }}"
                                        {{ old('costCentre', optional(optional($employee->employee)->costCentre)->id) == $costCentre->id ? 'selected' : '' }}>
                                        {{ $costCentre->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('costCentre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select @error('department') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['departments'] as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department', optional(optional($employee->employee)->department)->id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('department')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Section</label>
                            <select name="section" class="form-select @error('section') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['sections'] as $section)
                                    <option value="{{ $section->id }}"
                                        {{ old('section', optional(optional($employee->employee)->section)->id) == $section->id ? 'selected' : '' }}>
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('section')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['categories'] as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category', optional(optional($employee->employee)->category)->id) == $category->id ? 'selected' : '' }}>
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
                        <div class="mb-4">
                            <label class="form-label">Job Grade</label>
                            <select name="jobGrade" class="form-select @error('jobGrade') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['jobGrades'] as $jobGrade)
                                    <option value="{{ $jobGrade->id }}"
                                        {{ old('jobGrade', optional(optional($employee->employee)->jobGrade)->id) == $jobGrade->id ? 'selected' : '' }}>
                                        {{ $jobGrade->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('jobGrade')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Business Unit</label>
                            <select name="businessUnit" class="form-select @error('businessUnit') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['businessUnits'] as $businessUnit)
                                    <option value="{{ $businessUnit->id }}"
                                        {{ old('businessUnit', optional(optional($employee->employee)->businessUnit)->id) == $businessUnit->id ? 'selected' : '' }}>
                                        {{ $businessUnit->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('businessUnit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Qualification</label>
                            <select name="qualification" class="form-select @error('qualification') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($settings['qualifications'] as $qualification)
                                    <option value="{{ $qualification->id }}"
                                        {{ old('qualification', optional(optional($employee->employee)->qualification)->id) == $qualification->id ? 'selected' : '' }}>
                                        {{ $qualification->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('qualification')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5 mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-main btn-lg w-100">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
