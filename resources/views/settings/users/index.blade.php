@extends('layouts.master')
@section('page_title', __('lb.User'))
@section('directory', __('lb.User'))
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12">
                <button class="btn btn-primary tpg_bg" data-toggle="modal" data-target="#createModal">
                    <i class="fa fa-plus-circle"></i>
                    {{__('lb.Create')}}
                </button>
            </div>
        </div>

       <div class="row">
            <div class="col-sm-12">
                <table class="table table-sm table-bordered datatable" id='dataTable' style="width: 100%">
                    <thead class="bg-light">
                        <tr>
                            <th width="80">{{__('lb.No.')}}</th>
                            <th>{{__('lb.Full Name')}}</th>
                            <th>{{__('lb.Email')}}</th>
                            <th>{{__('lb.Username')}}</th>
                            <th>{{__('lb.Role')}}</th>
                            <th width="150">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.users.create')
@include('settings.users.edit')
@endsection

@section('script')
<script>
    $(document).ready(function () {

        var table = $('#dataTable').DataTable({
            lengthMenu: [
                [10, 50, 100, 1000],
                [10, 50, 100, 1000]
            ],
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{ route('setting.user.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'users.name'},
                {data: 'email', name: 'users.email'},
                {data: 'username', name: 'users.username'},
                {   data: 'role_name_en', name: 'roles.name'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        //Initialize Select2 Elements

        $(".select2").select2({
            theme: 'bootstrap4',
            dropdownParent: $('#createModal')
        });

        // $('#eemployee_id').select2({
        //     theme: 'bootstrap4',
        //     dropdownParent: $('#editModal')
        // });
    });

    function editRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('setting.user.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#erole_id').val(res.data.role_id);
                $('#euser_name').val(res.data.user);
                $("#eemployee_id").val(res.data.employee_id);
                // setTimeout(() => {
                //     $('#eemployee_id').trigger('change');
                // }, 500);
                $('#editModal').modal('show');
            }
        });
    }

</script>
@endsection
