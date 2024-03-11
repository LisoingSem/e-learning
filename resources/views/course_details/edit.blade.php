<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_edit" class="modal-content" method="post"
            onsubmit='frm_update(event, "{{route("video.update")}}")'>
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{__('lb.Edit')}}</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <input type="hidden" name="id" id="eid">
                <div class="row">
                    <div class="col-4">
                        <div class="col-sm-12 mb-3">
                            <label for="eordering">{{ __('lb.Ordering') }} <span class="text-danger">*</span></label>
                            <input type="number" name="ordering" id="eordering" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="eduration">{{ __('lb.Durations') }} <span class="text-danger">*</span></label>
                            <input type="number" name="duration" id="eduration" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="estatus">Status</label>
                            <select class="form-control" id="estatus" name="status">
                                <option value="1">Active</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="efile_url">{{ __('lb.Video URL') }} <span class="text-danger">*</span></label>
                            <input type="text" name="file_url" id="efile_url" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="col-sm-12 mb-3">
                            <label for="ename_kh">{{__('lb.Khmer Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name_kh" id="ename_kh" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="ename_en">{{__('lb.English Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name_en" id="ename_en" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="ecourse_id">{{ __('lb.Courses') }} <span class="text-danger">*</span></label>
                            <select class="form-control" id="ecourse_id" name="course_id" required>
                                <option selected disabled>Please select Category!!</option>
                                @foreach ($courses as $item)
                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="etrainner_id">{{ __('lb.Trainner') }} <span class="text-danger">*</span></label>
                            <select class="form-control" id="etrainner_id" name="trainner_id" required>
                                <option selected disabled>Please select Trainner!!</option>
                                @foreach ($trainners as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="edescription">{{__('lb.Description')}}<span class="text-danger">*</span></label>
                            <textarea name="description" id="edescription" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </form>
    </div>
</div>

