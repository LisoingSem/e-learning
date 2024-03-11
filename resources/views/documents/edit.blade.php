<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_edit" class="modal-content" method="post"
            onsubmit='frm_update(event, "{{route("document.update")}}")'>
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
                        <div class="col-12 mb-3">
                            <label for="efile_url">{{ __('lb.Documents') }}  URL <span class="text-danger">*</span></label>
                            <input type="text" name="file_url" id="efile_url" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="ethumbnail">{{__('lb.Photo')}} <span class="text-danger">*</span></label>
                            <br>
                            <span class="input-group-btn">
                                <a id="elfm" data-input="efilePathInput" data-preview="eholder"
                                    class="btn btn-outline-primary" style="width: 100%">
                                    <i class="fa fa-image"></i> Choose file
                                </a>
                            </span>
                            <input id="efilePathInput" class="form-control" type="hidden" name="cover">
                            <div id="eholder" style="margin-top:5px;max-width:100%;"></div>
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
                            <select class="form-control eselect_course" data-live-search="true" id="ecourse_id" name="course_id" title="Please select Course!!" required>\
                                @foreach ($courses as $item)
                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="etrainner_id">{{ __('lb.Trainner') }} <span class="text-danger">*</span></label>
                            <select class="form-control eselect_trainner" data-live-search="true" id="etrainner_id" name="trainner_id" title="Please select Trainner!!" required>
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
