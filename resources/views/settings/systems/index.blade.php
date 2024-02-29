@extends('layouts.master')
@section('page_title', 'គ្រប់គ្រងព័ត៌មានប្រព័ន្ធ')
@section('directory', 'គ្រប់គ្រងព័ត៌មានប្រព័ន្ធ')
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
                            <th>ឈ្មោះប្រព័ន្ធ(ខ្មែរ)</th>
                            <th>ឈ្មោះប្រព័ន្ធ(អង់គ្លេស)</th>
                            <th>ឈ្មោះកាត់(អង់គ្លេស)</th>
                            <th>បរិយាយ</th>
                            <th width="100">សកម្មភាព</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.systems.create')
@include('settings.systems.edit')
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
            ajax: "{{ route('setting.system.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'name'},
                {data: 'name_kh', name: 'name_kh'},
                {data: 'short_name', name: 'short_name'},
                {data: 'description', name: 'description'},
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
            url: "{{route('setting.system.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#ename').val(res.data.name);
                $('#ename_kh').val(res.data.name_kh);
                $('#eshort_name').val(res.data.short_name);
                $('#eroute_name').val(res.data.route_name);
                $('#edescription').val(res.data.description);
                $('#editModal').modal('show');
            }
        });
    }
    
</script>
@endsection
