@extends('layouts.master')
@section('page_title', 'System Modules')
@section('directory', 'System Modules')
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
                            <th>ប្រព័ន្ធគ្រប់គ្រង</th>
                            <th>ឈ្មោះម៉ឌុល(ខ្មែរ)</th>
                            <th>ឈ្មោះម៉ឌុល(អង់គ្លេស)</th>
                            <!-- <th>បរិយាយ</th> -->
                            <th width="120">សកម្មភាព</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.system_modules.create')
@include('settings.system_modules.edit')
@endsection

@section('script')
<script>
    $(document).ready(function () {
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
            ajax: "{{ route('setting.system_module.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'system_name', name: 'systems.name'},
                {data: 'name_kh', name: 'system_modules.name_kh'},
                {data: 'name', name: 'system_modules.name'},
                // {data: 'description', name: 'system_modules.description'},
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
            url: "{{route('setting.system_module.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#esystem_id').val(res.data.system_id);
                $('#ename').val(res.data.name);
                $('#ename_kh').val(res.data.name_kh);
                $('#eshort_name').val(res.data.short_name);
                $('#edescription').val(res.data.description);
                $('#eentity').val($(obj).attr('entity'));
                $('#eper').val($(obj).attr('per'));

                $('#editModal').modal('show');
            }
        });
    }
    
</script>
@endsection
