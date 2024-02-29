@extends('layouts.master')
@section('page_title', 'System Feature for module: '.$system_feature->name)
@section('directory', 'System Feature for module: '.$system_feature->name)
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('setting.system_feature.index', myEncrypt($system_feature->module_id))}}" class="btn btn-info btn"><i class="fa fa-arrow-left"></i> បកក្រោយ</a>
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
                            <th width="50">ល.រ</th>
                            <th>Links</th>
                            <th width="120">សកម្មភាព</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.feature_links.create')
@include('settings.feature_links.edit')
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            // pageLength: [100],
            lengthMenu: [
                [20, 50, 100, 1000],
                [20, 50, 100, 1000]
            ],
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{ route('setting.feature_link.index', request()->id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'feature_links.name'},
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
            url: "{{route('setting.feature_link.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#ename').val(res.data.name);
                $('#editModal').modal('show');
            }
        });
    }
    
</script>
@endsection
