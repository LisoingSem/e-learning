<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="form_edit" class="modal-content" method="post" onsubmit='frm_update(event, "{{route("agency.update")}}")'>
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
            <div class="col-sm-6 mb-3">
                <label for="name">{{__('lb.Khmer Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name_kh" id="ename_kh" class="form-control" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="name_kh">{{__('lb.English Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name_en" id="ename_en" class="form-control" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="name_kh">{{__('lb.Registration Number')}} <span class="text-danger">*</span></label>
                <input type="text"  name="registration_no" id="eregistration_no" class="form-control" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="name_kh">{{__('lb.Registration Date')}} <span class="text-danger">*</span></label>
                <input type="date"  name="registration_date" id="eregistration_date" class="form-control" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="name_kh">{{__('lb.Phone Number')}} <span class="text-danger">*</span></label>
                <input type="text" name="phone_number" id="ephone_number" class="form-control" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="elogo">{{__('lb.Logo')}} <span class="text-danger">*</span></label>
                <br>
                <label for="elogo" >
                    <img id="eagency_logo" src="" height="40">
                </label>

                <input type="file" name="logo" id="elogo" class="form-control d-none" >
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.Address')}} <span class="text-danger">*</span></label>
                <input type="text" name="address" id="eaddress" class="form-control" required>
            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </form>
  </div>
</div>
