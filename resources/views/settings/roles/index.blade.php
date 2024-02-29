@extends('layouts.master')
@section('page_title', 'Roles')
@section('directory', 'Roles')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fa fa-plus-circle"></i>
                    បង្កើតថ្មី
                </button>
            </div>
        </div>

       <div class="row">
            <div class="col-sm-12">
                <table class="table table-sm table-bordered datatable" id='dataTable' style="width: 100%">
                    <thead class="bg-light">
                        <tr>
                            <th>ល.រ</th>
                            <th>ឈ្មោះតួនាទី(ខ្មែរ)</th>
                            <th>ឈ្មោះតួនាទី(អង់គ្លេស)</th>
                            <th width="120">សកម្មភាព</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.roles.create')
@include('settings.roles.edit')
@endsection

@section('script')
<script>
    $(document).ready(function () {
        // active menu 
        $("#operation_setting_menu").addClass("menu-open"); 
        var table = $('#dataTable').DataTable({
            // pageLength: [100],
            lengthMenu: [
                [20, 50, 100, 1000],
                [20, 50, 100, 1000]
            ],
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{ route('setting.role.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name_kh', name: 'name_kh'},
                {data: 'name', name: 'name'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });
    });

    function editRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('setting.role.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#ename').val(res.data.name);
                $('#ename_kh').val(res.data.name_kh);
                $('#editModal').modal('show');
            }
        });
    }
    
</script>
@endsection
