<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_edit" class="modal-content" method="post"
            onsubmit='frm_update(event, "{{route("trainner.update")}}")'>
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
                            <label for="experience">Expericence <span class="text-danger">*</span></label>
                            <input type="number" name="year_experience" id="eexperience" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="egender" name="gender" required>
                                <option selected disabled>Please select Gender!!</option>
                                <option value="0">Female</option>
                                <option value="1">Male</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="ethumbnail">{{__('lb.Logo')}} <span class="text-danger">*</span></label>
                            <br>
                            <span class="input-group-btn">
                                <a id="elfm" data-input="efilePathInput" data-preview="eholder"
                                    class="btn btn-outline-primary" style="width: 100%">
                                    <i class="fa fa-image"></i> Choose file
                                </a>
                            </span>
                            <input id="efilePathInput" class="form-control" type="hidden" name="photo">
                            <div id="eholder" style="margin-top:5px;max-width:100%;"></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="col-sm-12 mb-3">
                            <label for="name">{{__('lb.Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="ename" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="email">{{__('lb.Email')}} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="eemail" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="phone">Phone Number<span class="text-danger">*</span></label>
                            <input type="number" name="phone_number" id="enumber" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="skills">SKills<span class="text-danger">*</span></label>
                            <input type="text" name="skills" id="eskills" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="description">Description<span class="text-danger">*</span></label>
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
