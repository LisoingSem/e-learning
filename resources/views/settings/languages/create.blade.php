<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="form_create" class="modal-content" method="post" onsubmit='frm_submit(event, "{{route("setting.language.save")}}")'>
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">{{__('lb.Create')}}</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        @csrf
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="name">{{__('lb.Khmer Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name_kh" id="name_kh" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.English Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name_en" id="name_en" class="form-control" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('lb.Save')}}</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> {{__('lb.Close')}}</button>
      </div>
    </form>
  </div>
</div>