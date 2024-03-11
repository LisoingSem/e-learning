<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_create" class="modal-content" method="post"
            onsubmit='frm_submit(event, "{{route("document.save")}}")'>
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
                        <div class="col-12 mb-3">
                            <label for="file_url">{{ __('lb.Documents') }}  URL <span class="text-danger">*</span></label>
                            <input type="text" name="file_url" id="file_url" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="thumbnail">{{__('lb.Photo')}} <span class="text-danger">*</span></label>
                            <br>
                            <span class="input-group-btn">
                                <a id="lfm" data-input="filePathInput" data-preview="holder"
                                    class="btn btn-outline-primary" style="width: 100%">
                                    <i class="fa fa-image"></i> Choose
                                </a>
                            </span>
                            <input id="filePathInput" class="form-control" type="hidden" name="cover">
                            <div id="holder" style="margin-top:5px;max-width:100%;"></div>
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
                            <select class="select_course form-control" data-live-search="true" id="course_id" name="course_id" title="Please select Course!!" required>
                                @foreach ($courses as $item)
                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="trainner_id">{{ __('lb.Trainner') }} <span class="text-danger">*</span></label>
                            <select class="form-control select_trainner" data-live-search="true" id="trainner_id" name="trainner_id" title="Please select Trainner!!" required>
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
