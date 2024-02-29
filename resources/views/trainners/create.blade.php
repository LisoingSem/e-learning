<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_create" class="modal-content" method="post"
            onsubmit='frm_submit(event, "{{route("trainner.save")}}")'>
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
                            <label for="experience">Expericence <span class="text-danger">*</span></label>
                            <input type="number" name="year_experience" id="experience" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option selected disabled>Please select Gender!!</option>
                                <option value="0">Female</option>
                                <option value="1">Male</option>
                            </select>
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
                            <input id="filePathInput" class="form-control" type="hidden" name="photo">
                            <div id="holder" style="margin-top:5px;max-width:100%;"></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="col-sm-12 mb-3">
                            <label for="name">{{__('lb.Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="email">{{__('lb.Email')}} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="phone">Phone Number<span class="text-danger">*</span></label>
                            <input type="number" name="phone_number" id="number" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="skills">SKills<span class="text-danger">*</span></label>
                            <input type="text" name="skills" id="skills" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="description">Description<span class="text-danger">*</span></label>
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
