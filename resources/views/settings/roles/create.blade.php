<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="form_create" class="modal-content" method="post" onsubmit='frm_submit(event, "{{route("setting.role.save")}}")'>
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
                <label for="name">ឈ្មោះប្រព័ន្ធ (អង់គ្លេស) <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">ឈ្មោះប្រព័ន្ធ (ខ្មែរ) <span class="text-danger">*</span></label>
                <input type="text" name="name_kh" id="name_kh" class="form-control" required>
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