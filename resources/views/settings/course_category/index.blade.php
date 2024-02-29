@extends('layouts.master')

@section('page_title', __('lb.Course Category'))
@section('directory', __('lb.Course Category'))

@section('css')
<style>
    tbody tr td:nth-child(5),
    td:nth-child(6),
    td:nth-child(7) {
        text-align: center;
    }

    .dataTables_wrapper .row:nth-child(2) {
        overflow-y: scroll;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12 d-flex justify-content-end" style="gap: 10px">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fa fa-plus-circle"></i>
                    {{__('lb.Create')}}
                </button>
                <button class="btn btn-outline-warning" id="disableButton"
                    onclick="disabledData('{{ route('setting.course_category.data') }}')">
                    <i class="fa fa-exclamation-triangle"></i> Hidden
                </button>
                <button class="btn btn-outline-danger" id="trushButton"
                    onclick="trushData('{{ route('setting.course_category.data') }}')">
                    <i class="fa fa-trash"></i> Trush
                </button>
                <button class="btn btn-success" id="refreshButton"
                    onclick="refreshData('{{ route('setting.course_category.data') }}')">
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-sm table-bordered datatable" id='dataTable' style="width: 100%">
                    <thead class="bg-light">
                        <tr>
                            <th>{{__('lb.No.')}}</th>
                            <th width="20">{{__('lb.Logo')}}</th>
                            <th>{{__('lb.Khmer Name')}}</th>
                            <th>{{__('lb.English Name')}}</th>
                            <th width="90px">{{__('lb.Ordering')}}</th>
                            <th width="100">{{__('lb.Status')}}</th>
                            <th width="100">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('settings.course_category.create')
@include('settings.course_category.edit')

@endsection
@section('script')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('file');
    $('#elfm').filemanager('file');

    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            lengthMenu: [
                [20, 50, 100, 1000],
                [20, 50, 100, 1000]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('setting.course_category.data') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'thumbnail', name: 'thumbnail',  searchable: false, orderable: false},
                {data: 'name_kh', name: 'name_kh'},
                {data: 'name_en', name: 'name_en'},
                {data: 'ordering', name: 'ordering'},
                {
                    data: 'status',
                    name: 'course_categories.status',
                    orderable: false,
                    searchable: false,
                    mRender: function (data, type, row) {
                        if(data == 1){
                            return  '<span class="btn btn-success btn-xs"> {{__('lb.Active')}}</span>'
                        }else{
                            return  '<span class="btn btn-danger btn-xs"> {{__('lb.Disabled')}}</span>'
                        }
                    }
                },
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
            url: "{{route('setting.course_category.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eholder').empty();
                $('#eid').val($(obj).attr('key'));
                $('#ename_en').val(res.data.name_en);
                $('#ename_kh').val(res.data.name_kh);
                $('#eordering').val(res.data.ordering);
                $('#efilePathInput').val(res.data.thumbnail);
                $('#eholder').append(
                    $('<img>').css({
                        'height': '100%',
                        'width': '100%',
                        'object-fit': 'cover',
                    }).attr('src', res.data.thumbnail)
                );
                $('#estatus').val(res.data.status);
                $('#editModal').modal('show');
            }
        });
    }

</script>
@endsection
