@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Edit Employee</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.employee.index') }}">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form method="post" action="{{ route('superadmin.employee.update', $employee->id) }}">
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
                    @if($employee->getRoles()[0] == 'hradmin')
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">User Security Group</label>
                                @foreach ($settings['securityGroups'] as $securityGroup)
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="securityGroup{{ $securityGroup->id }}" 
                                            name="userSecurityGroups[]" 
                                            value="{{ $securityGroup->id }}"
                                            
                                            {{-- Check if this security group is selected in the old input or already belongs to the user --}}
                                            {{ in_array($securityGroup->id, old('userSecurityGroups', $employee->securityGroups->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        
                                        <label class="form-check-label" for="securityGroup{{ $securityGroup->id }}">
                                            {{ $securityGroup->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <hr>                       
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<top class="text-danger">*</top></label>
                            <select id="client" name="client" class="form-select @error('client') is-invalid @enderror">
                                <option value="">Please Select</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        data-companies="{{ json_encode($client->companies) }}"
                                        {{ old('client', $employee->companies->first()->client->id) == $client->id ? 'selected' : '' }}>
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
                            <select id="company" class="form-select @error('company') is-invalid @enderror" name="company">
                                <option value="">Please Select</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company', $employee->companies->first()->id) == $company->id ? 'selected' : '' }}>
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
                        <div class="mb-3">
                            <label class="form-label">Employee No</label>
                            <input name="employee_id" type="text"
                                class="form-control @error('employee_id') is-invalid @enderror"
                                value="{{ old('employee_id', $employee->employee->employee_id) }}">

                            @error('employee_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Short Name</label>
                            <input name="short_name" type="text"
                                class="form-control @error('short_name') is-invalid @enderror"
                                value="{{ old('short_name', $employee->employee->short_name) }}">

                            @error('short_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Date Of Birth</label>
                            <input name="dob" type="date"
                                class="form-control @error('dob') is-invalid @enderror"
                                value="{{ old('dob', $employee->employee->dob) }}">

                            @error('dob')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="" selected disabled>Please Select</option>
                                <option value="Male" {{ old('gender', $employee->employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $employee->employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>

                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Marital Status</label>
                            <select name="marital_status" class="form-select @error('marital_status') is-invalid @enderror">
                                <option value="" selected disabled>Please Select</option>
                                <option value="Single" {{ old('marital_status', $employee->employee->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ old('marital_status', $employee->employee->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Divorced" {{ old('marital_status', $employee->employee->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="Widow" {{ old('marital_status', $employee->employee->marital_status) == 'Widow' ? 'selected' : '' }}>Widow</option>
                                <option value="Widower" {{ old('marital_status', $employee->employee->marital_status) == 'Widower' ? 'selected' : '' }}>Widower</option>
                            </select>

                            @error('marital_status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Home No</label>
                            <input name="home_no" type="text"
                                class="form-control @error('home_no') is-invalid @enderror"
                                value="{{ old('home_no', $employee->employee->home_no) }}">

                            @error('home_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Mobile No</label>
                            <input name="mobile_no" type="text"
                                class="form-control @error('mobile_no') is-invalid @enderror"
                                value="{{ old('mobile_no', $employee->employee->mobile_no) }}">

                            @error('mobile_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Group Join Date</label>
                            <input name="group_join_date" type="date"
                                class="form-control @error('group_join_date') is-invalid @enderror"
                                value="{{ old('group_join_date', $employee->employee->group_join_date) }}">

                            @error('group_join_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Join Date</label>
                            <input name="join_date" type="date"
                                class="form-control @error('join_date') is-invalid @enderror"
                                value="{{ old('join_date', $employee->employee->join_date) }}">

                            @error('join_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Confirm Date</label>
                            <input name="confirm_date" type="date"
                                class="form-control @error('confirm_date') is-invalid @enderror"
                                value="{{ old('confirm_date', $employee->employee->confirm_date) }}">

                            @error('confirm_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Increment Date</label>
                            <input name="increment_date" type="date"
                                class="form-control @error('increment_date') is-invalid @enderror"
                                value="{{ old('increment_date', $employee->employee->increment_date) }}">

                            @error('increment_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Resign Date</label>
                            <input name="resign_date" type="date"
                                class="form-control @error('resign_date') is-invalid @enderror"
                                value="{{ old('resign_date', $employee->employee->resign_date) }}">

                            @error('resign_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Retire Date</label>
                            <input name="retire_date" type="date"
                                class="form-control @error('retire_date') is-invalid @enderror"
                                value="{{ old('retire_date', $employee->employee->retire_date) }}">

                            @error('retire_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Probation End Date</label>
                            <input name="probation_end_date" type="date"
                                class="form-control @error('probation_end_date') is-invalid @enderror"
                                value="{{ old('probation_end_date', $employee->employee->probation_end_date) }}">

                            @error('probation_end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Work Type</label>
                            <select name="work_type" class="form-select @error('work_type') is-invalid @enderror">
                                <option value="" selected disabled>Please Select</option>
                                <option value="Management" {{ old('work_type', $employee->employee->work_type) == 'Management' ? 'selected' : '' }}>Management</option>
                                <option value="FullTime" {{ old('work_type', $employee->employee->work_type) == 'FullTime' ? 'selected' : '' }}>FullTime</option>
                                <option value="PartTime" {{ old('work_type', $employee->employee->work_type) == 'PartTime' ? 'selected' : '' }}>PartTime</option>
                                <option value="Contract" {{ old('work_type', $employee->employee->work_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ old('work_type', $employee->employee->work_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Others" {{ old('work_type', $employee->employee->work_type) == 'Others' ? 'selected' : '' }}>Others</option>
                            </select>

                            @error('work_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <input name="designation" type="text"
                                class="form-control @error('designation') is-invalid @enderror"
                                value="{{ old('designation', $employee->employee->designation) }}">

                            @error('designation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
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
    @include ('superadmin.employee.script')
@endsection
