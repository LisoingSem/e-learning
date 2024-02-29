<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_create" class="modal-content" method="post"
            onsubmit='frm_submit(event, "{{route("video.save")}}")'>
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">{{__('lb.Create')}}</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <input type="hidden" name="course_id" value="{{ $details->id }}">
                <input type="hidden" name="trainner_id" value="{{ $details->trainner_id }}">

                <div class="row">
                    <div class="col-4">
                        <div class="col-sm-12 mb-3">
                            <label for="ordering">Ordering <span class="text-danger">*</span></label>
                            <input type="number" name="ordering" id="ordering" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="duration">Durations</label>
                            <input type="number" name="duration" id="duration" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="file_url">Video URL <span class="text-danger">*</span></label>
                            <input type="text" name="file_url" id="file_url" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="col-sm-12 mb-3">
                            <label for="name_kh">{{__('lb.Khmer Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name_kh" id="name_kh" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="name_en">{{__('lb.English Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name_en" id="name_en" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="description">{{__('lb.Description')}}<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('lb.Save')}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    {{__('lb.Close')}}</button>
            </div>
        </form>
    </div>
</div>
