<!-- Edit Question Modal -->
<div class="modal fade modal-movement" id="edit-employee-question-modal-{{ $key }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">Edit Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route(auth()->user()->getRoles()[0].'.setups.employee-feedback.update-question', $ques) }}">
            @csrf
            <div class="modal-body border-bottom text-start mb-3">
                <div class="row">
                    <div class="col-md-12">
                         <div class="mb-3">
                            <label class="form-label"> Question <top class="text-danger">*</top></label>
                            <input name="question" type="text"
                                class="form-control @error('question') is-invalid @enderror"
                                value="{{ old('question', $ques->question) }}">
                            @error('question')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="hidden" name="employee_feedback_id" value="{{ $employeeFeedback->id }}">
                        </div>
                    </div>
                </div>       
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form> 
        </div>
    </div>
</div>