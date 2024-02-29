<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="form_create" class="modal-content" method="post" onsubmit='frm_submit(event, "{{route("setting.user.save")}}")'>
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">បង្កើតថ្មី</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        @csrf
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="employee_id">{{__('lb.Role')}} <span class="text-danger">*</span></label>
                <select name="role_id" id="role_id" class="form-control">
                  <option value="">-----</option>
                  @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->name}} ({{$role->name_kh}})</option>
                  @endforeach
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="user_name">{{__('lb.Full Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name" id="full_name" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="user_name">{{__('lb.Email')}} <span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="user_name">{{__('lb.Username')}} <span class="text-danger">*</span></label>
                <input type="text" name="username" id="user_name" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="password">{{__('lb.Password')}} <span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control" required>
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