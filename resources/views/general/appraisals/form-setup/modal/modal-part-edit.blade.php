<!-- Add Staff Modal -->
<div class="modal fade modal-movement" id="modal-part-edit-{{ $key }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">Edit Part Appraisals</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{  route(auth()->user()->getRoles()[0].'.appraisals.form-setups.part-update', $appraisalPart) }}">
            @csrf
            @method('PUT')
            <div class="modal-body border-bottom text-start mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Title <top class="text-danger">*</top> </label>
                            <input type="text" class="form-control" name="title" value="{{ $appraisalPart->title }}" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Weightage %<top class="text-danger">*</top> </label>
                            <input type="number" class="form-control" name="weightage" value="{{ $appraisalPart->weightage }}" placeholder="Title" required>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>