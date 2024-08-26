<div class="card card-dashboard mt-5">
    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    <label for="current-password" class="form-label">Current Password</label>
                    <div class="mb-3 form-password">
                        <input type="password" name="current_password" id="current-password"
                            class="form-control @error('current_password') is-invalid @enderror" required>
                        <i class="bx bxs-show show-password"></i>

                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label form-password">New Password</label>
                    <div class="mb-3 form-password">    
                        <input name="new_password" type="password"
                            class="form-control @error('new_password') is-invalid @enderror" required>
                        <i class="bx bxs-show show-password"></i>

                        @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Confirm New Password</label>
                    <div class="mb-3 form-password">
                        <input name="new_password_confirmation" type="password"
                            class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                        <i class="bx bxs-show show-password"></i>

                        @error('new_password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5 mb-3">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-main btn-lg w-100">Update Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
