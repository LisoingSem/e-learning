<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_create" class="modal-content" method="post"
            onsubmit='frm_submit(event, "{{route("course.save")}}")'>
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
                            <label for="code">{{__('lb.Code')}} <span class="text-danger">*</span></label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="total_hours">{{__('lb.Total Hours')}} <span class="text-danger">*</span></label>
                            <input type="text" name="total_hours" id="total_hours" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="price">{{__('lb.Price')}} <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="ordering">{{__('lb.Ordering')}} <span class="text-danger">*</span></label>
                            <input type="number" name="ordering" id="ordering" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="thumbnail">{{__('lb.Logo')}} <span class="text-danger">*</span></label>
                            <br>
                            <span class="input-group-btn">
                                <a id="lfm" data-input="filePathInput" data-preview="holder"
                                    class="btn btn-outline-primary" style="width: 100%">
                                    <i class="fa fa-image"></i> Choose
                                </a>
                            </span>
                            <input id="filePathInput" class="form-control" type="hidden" name="thumbnail">
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
                            <label for="course_category_id">{{ __('lb.Course Category') }} <span class="text-danger">*</span></label>

                            <div class="row">
                                <div class="col-12 d-flex">
                                    @foreach ($course_categories as $item)
                                    <div class="form-check form-check-inline btn btn-outline-secondary d-flex align-items-center justify-content-center">
                                        <input class="form-check-input text-lg" type="checkbox" name="course_category_id[]"
                                            id="inlineCheckbox{{ $item->id }}" value="{{ $item->id }}">
                                        <label class="form-check-label" for="inlineCheckbox{{ $item->id }}">{{
                                            $item->name_en }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
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
                            <label for="short_description">{{__('lb.Short Description')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="short_description" id="short_description" class="form-control"
                                required>
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
