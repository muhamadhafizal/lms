<!-- Edit Staff Modal -->
<div class="modal fade modal-movement" id="edit-staff-modal-{{ $key }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">Staff Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="card card-dashboard mb-3">
                    <div class="card-body">
                        <form method="post" action="{{ route('superadmin.user.update', $staff) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"> Name <top class="text-danger">*</top></label>
                                        <input type="text" class="form-control input-group @error('user_name') is-invalid @enderror" name="user_name"
                                            value="{{ old('user_name', $staff->user_name) }}">

                                        @error('user_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label"> Email <top class="text-danger">*</top></label>
                                        <input type="text" class="form-control input-group @error('user_email') is-invalid @enderror" name="user_email"
                                            value="{{ old('user_email', $staff->user_email) }}">

                                        @error('user_email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>   
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Language</label>
                                        <select name="user_language" class="form-select @error('user_language') is-invalid @enderror select-tagging">
                                            <option value="" selected disabled>Please Select</option>
                                            <option value="English" {{ old('user_language', $staff->user_language ?? '') == 'English' ? 'selected' : '' }}>English</option>
                                            <option value="Malay" {{ old('user_language', $staff->user_language ?? '') == 'Malay' ? 'selected' : '' }}>Malay</option>
                                            <option value="Chinese" {{ old('user_language', $staff->user_language ?? '') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                            <option value="Tamil" {{ old('user_language', $staff->user_language ?? '') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                                        </select>
                                    
                                        @error('user_language')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status <top class="text-danger">*</top></label>
                                        <select name="user_status" class="form-select">
                                            <option value="1" selected>Active</option>
                                            <option value="0"
                                                {{ old('user_status', $staff->user_status) == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                        </select>

                                        @error('user_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <div class="mb-3">
                                        <button type="submit" class="form-control btn btn-primary">Update</button>
                                    </div>   
                                </div>
                            </div>
                        </form>
                    </div> 
                </div> 
                <div class="card card-dashboard">
                    <div class="card-body">
                        <form method="post" action="{{ route('superadmin.user.updatepassword', $staff) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label"> New Password <top class="text-danger">*</top></label>
                                    <div class="mb-3 form-password">
                                        <input type="password" class="form-control input-group @error('password') is-invalid @enderror" name="password">
                                        <i class="bx bxs-show show-password"></i>

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm New Password <top class="text-danger">*</top></label>
                                    <div class="mb-3 form-password">
                                        <input name="confirm_password" type="password"
                                            class="form-control @error('confirm_password') is-invalid @enderror" required>
                                        <i class="bx bxs-show show-password"></i>

                                        @error('confirm_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <div class="mb-3">
                                        <button type="submit" class="form-control btn btn-primary">Update Password</button>
                                    </div>   
                                </div>
                            </div>
                        </form>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</div>