<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_edit" class="modal-content" method="post"
            onsubmit='frm_update(event, "{{route("course.update")}}")'>
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
                            <label for="code">{{__('lb.Code')}} <span class="text-danger">*</span></label>
                            <input type="text" name="code" id="ecode" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="total_hours">{{__('lb.Total Hours')}} <span class="text-danger">*</span></label>
                            <input type="text" name="total_hours" id="etotal_hours" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="price">{{__('lb.Price')}} <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="eprice" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="ordering">{{__('lb.Ordering')}} <span class="text-danger">*</span></label>
                            <input type="number" name="ordering" id="eordering" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="estatus">{{ __('lb.Status') }} <span class="text-danger">*</span></label>
                            <select class="form-control" id="estatus" name="status">
                                <option value="1">{{ __('lb.Active') }}</option>
                                <option value="0">{{ __('lb.Disabled') }}</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="thumbnail">{{__('lb.Thumbnail')}} <span class="text-danger">*</span></label>
                            <br>
                            <span class="input-group-btn">
                                <a id="elfm" data-input="efilePathInput" data-preview="eholder"
                                    class="btn btn-outline-primary" style="width: 100%">
                                    <i class="fa fa-image"></i> Choose file
                                </a>
                            </span>
                            <input id="efilePathInput" class="form-control" type="hidden" name="thumbnail">
                            <div id="eholder" style="margin-top:5px;max-width:100%;"></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="col-sm-12 mb-3">
                            <label for="name_kh">{{__('lb.Khmer Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name_kh" id="ename_kh" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="name_en">{{__('lb.English Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name_en" id="ename_en" class="form-control" required>
                        </div>
                        {{--<div class="col-sm-12 mb-3">
                            <label for="course_category_id">{{ __('lb.Course Category') }} <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-12 d-flex">
                                    @foreach ($course_categories as $item)
                                    <div
                                        class="form-check form-check-inline btn btn-outline-secondary d-flex align-items-center justify-content-center">
                                        <input class="form-check-input text-lg" type="checkbox"
                                            id="einlineCheckbox{{ $item->id }}" name="course_category_id[]" value="{{ $item->id }}">
                                        <label class="form-check-label" for="einlineCheckbox{{ $item->id }}">{{
                                            $item->name_en }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="trainner_id">{{ __('lb.Trainner') }} <span class="text-danger">*</span></label>
                            <select class="form-control" id="etrainner_id" name="trainner_id" required>
                                <option selected disabled>Please select Trainner!!</option>
                                @foreach ($trainners as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>--}}
                        <div class="col-sm-12 mb-3">
                            <label for="ecourse_category_id">{{ __('lb.Course Category') }} <span class="text-danger">*</span></label>
                            <select class="form-control eselect_course" data-live-search="true" id="ecourse_category_id" name="course_category_id[]" multiple data-actions-box="true" title="Please select Course!!" required>
                                @foreach ($course_categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="trainner_id">{{ __('lb.Trainner') }} <span class="text-danger">*</span></label>
                            <select class="form-control eselect_trainner text-black" data-live-search="true" id="etrainner_id" name="trainner_id" title="Please select Trainner!!"  required>
                                @foreach ($trainners as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="short_description">{{__('lb.Short Description')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="short_description" id="eshort_description" class="form-control"
                                required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="description">{{__('lb.Description')}}<span class="text-danger">*</span></label>
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
