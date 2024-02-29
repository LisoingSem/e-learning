<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_edit" class="modal-content" method="post"
            onsubmit='frm_update(event, "{{route("setting.course_category.update")}}")'>
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
                            <label for="ordering">{{__('lb.Ordering')}} <span class="text-danger">*</span></label>
                            <input type="number" name="ordering" id="eordering" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="estatus">Status</label>
                            <select class="form-control" id="estatus" name="status">
                                <option value="1">Active</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="ethumbnail">{{__('lb.Logo')}} <span class="text-danger">*</span></label>
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
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </form>
    </div>
</div>
