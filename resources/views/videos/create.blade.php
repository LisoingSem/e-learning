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
                <div class="row">
                    <div class="col-4">
                        <div class="col-sm-12 mb-3">
                            <label for="ordering">{{ __('lb.Ordering') }} <span class="text-danger">*</span></label>
                            <input type="number" name="ordering" id="ordering" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="duration">{{ __('lb.Durations') }} <span class="text-danger">*</span></label>
                            <input type="number" name="duration" id="duration" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="file_url">{{ __('lb.Video URL') }} <span class="text-danger">*</span></label>
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
                            <label for="course_id">{{ __('lb.Courses') }} <span class="text-danger">*</span></label>
                            <select class="form-control" id="course_id" name="course_id" required>
                                <option selected disabled>Please select Category!!</option>
                                @foreach ($courses as $item)
                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="trainner_id">{{ __('lb.Trainner') }} <span class="text-danger">*</span></label>
                            <select class="form-control" id="trainner_id" name="trainner_id" required>
                                <option selected disabled>Please select Trainner!!</option>
                                @foreach ($trainners as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
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
