<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="form_edit" class="modal-content" method="post" onsubmit='frm_update(event, "{{route("setting.user.update")}}")'>
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">កែប្រែ</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        @csrf
        <input type="hidden" name="id" id="eid">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="employee_id">Role <span class="text-danger">*</span></label>
                <select name="role_id" id="erole_id" class="form-control">
                  <option value="">-----</option>
                  @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->name}} ({{$role->name_kh}})</option>
                  @endforeach
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="user_name">គណនី <span class="text-danger">*</span></label>
                <input type="text" id="euser_name" class="form-control" readonly required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="password">លេខសម្ងាត់ <span class="text-danger"></span></label>
                <input type="password" name="password" id="password" class="form-control">
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