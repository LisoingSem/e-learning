@extends('layouts.master')
@section('page_title', __('lb.Languages'))
@section('directory', __('lb.Languages'))
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
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
                            <th>{{__('lb.No.')}}</th>
                            <th>{{__('lb.Khmer Name')}}</th>
                            <th>{{__('lb.English Name')}}</th>
                            <th width="100">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.languages.create')
@include('settings.languages.edit')
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
            ajax: "{{ route('setting.language.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name_kh', name: 'name_kh'},
                {data: 'name_en', name: 'name_en'},
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
            url: "{{route('setting.language.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#ename_en').val(res.data.name_en);
                $('#ename_kh').val(res.data.name_kh);
                $('#editModal').modal('show');
            }
        });
    }
    
</script>
@endsection
