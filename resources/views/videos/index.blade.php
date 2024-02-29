@extends('layouts.master')

@section('page_title', __('lb.Videos'))
@section('directory', __('lb.Videos'))

@section('css')
<style>

    tbody tr td:nth-child(10),
    td:nth-child(9) {
        text-align: center;
    }

    .dataTables_wrapper .row:nth-child(2){
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
                    onclick="disabledData('{{ route('video.data') }}')">
                    <i class="fa fa-exclamation-triangle"></i> {{ __('lb.Hidden') }}
                </button>
                <button class="btn btn-outline-danger" id="trushButton"
                    onclick="trushData('{{ route('video.data') }}')">
                    <i class="fa fa-trash"></i> {{ __('lb.Trash') }}
                </button>
                <button class="btn btn-success" id="refreshButton" onclick="refreshData('{{ route('video.data') }}')">
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                    <table class="table table-sm table-bordered datatable" class="display" id='dataTable' style="overflow-x: scroll"
                        style="width: 100%;">
                        <thead class="bg-light">
                            <tr>
                                <th width="70px">{{__('lb.No.')}}</th>
                                <th>{{__('lb.English Name')}}</th>
                                <th>{{__('lb.Khmer Name')}}</th>
                                <th>{{__('lb.Durations')}}</th>
                                <th>{{__('lb.Courses')}}</th>
                                <th>{{__('lb.Trainner')}}</th>
                                <th>{{__('lb.Ordering')}}</th>
                                <th width="100">{{__('lb.Status')}}</th>
                                <th width="100">{{__('lb.Action')}}</th>
                            </tr>
                        </thead>
                    </table>
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>

@include('videos.create')
@include('videos.edit')

@endsection
@section('script')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(document).ready(function () {

        $('#lfm').filemanager('file');
        $('#elfm').filemanager('file');

        var table = $('#dataTable').DataTable({
            lengthMenu: [
                [20, 50, 100, 1000],
                [20, 50, 100, 1000]
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('video.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name_en', name: 'name_en'},
                {data: 'name_kh', name: 'name_kh'},
                {
                    data: 'duration',
                    name: 'duration',
                    render: function(data) {
                    return data + 'mn';
                    }
                },
                {data: 'course_name', name: 'course_name'},
                {data: 'trainner_name', name: 'trainner_name'},
                {data: 'ordering', name: 'ordering'},
                {
                    data: 'status',
                    name: 'status',
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
            url: "{{route('video.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#ecode').val(res.data.code);
                $('#eduration').val(res.data.duration);
                $('#eprice').val(res.data.price);
                $('#eordering').val(res.data.ordering);
                $('#ename_kh').val(res.data.name_kh);
                $('#ename_en').val(res.data.name_en);
                $('#enumber').val(res.data.phone_number);
                $('#estatus').val(res.data.status);
                $('#ecourse_category_id').val(res.data.course_category_id);
                $('#ecourse_id').val(res.data.course_id);
                $('#etrainner_id').val(res.data.trainner_id);
                $('#edescription').val(res.data.description);
                $('#eshort_description').val(res.data.short_description);
                $('#efile_url').val(res.data.file_url);
                $('#editModal').modal('show');
            }
        });
    }

</script>
@endsection
