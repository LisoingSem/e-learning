<!-- Modal Create -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="form_edit" class="modal-content" method="post" onsubmit='frm_update(event, "{{route("setting.group.update")}}")'>
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
            <div class="col-sm-12 mb-3">
                <label for="name">{{__('lb.Khmer Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name_kh" id="ename_kh" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.English Name')}} <span class="text-danger">*</span></label>
                <input type="text" name="name_en" id="ename_en" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.Country')}} <span class="text-danger">*</span></label>
                <select onchange="getFactory(this)" name="country_id" id="ecountry_id" class="form-control" required>
                  <option value="">-----</option>
                  @foreach($countries as $country)
                  <option value="{{$country->id}}">{{$country->name_kh}} ({{$country->name_en}})</option>
                  @endforeach
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.Factory')}} <span class="text-danger">*</span></label>
                <select name="factory_id" id="efactory_id" class="form-control" required>
                  <option value="">-----</option>
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.Departure Date')}} <span class="text-danger">*</span></label>
                <input type="date" name="departure_date" id="edeparture_date" class="form-control" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="name_kh">{{__('lb.Address')}} <span class="text-danger">*</span></label>
                <input type="text" name="address" id="eaddress" class="form-control" required>
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