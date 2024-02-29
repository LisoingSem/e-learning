@extends('layouts.master')

@section('page_title', __('lb.Courses'))
@section('directory', __('lb.Course Information'))

@section('css')
<style>
    tbody tr td:nth-child(3),
    td:nth-child(4),
    td:nth-child(5) {
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
        <div class="row">
            <div class="col-12">
                <h5>{{ __('lb.Course Information') }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Code') }}</div>
                    <div class="font-weight-bold">{{ ($details->code) ? $details->code : '---' }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Price') }}</div>
                    <div class="font-weight-bold">{{ ($details->price) ? '$'. $details->price : '---' }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Total Hours') }}</div>
                    <div class="font-weight-bold">{{ ($details->total_hours) ? $details->total_hours.'h' : '---' }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.English Name') }}</div>
                    <div class="font-weight-bold">{{ ($details->name_en) ? $details->name_en : '---' }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Khmer Name') }}</div>
                    <div class="font-weight-bold">{{ ($details->name_kh) ? $details->name_kh : '---' }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Status') }}</div>
                    <div class="font-weight-bold">{{ ($details->status == 1) ? 'Active' : 'Disabled' }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Trainner') }}</div>
                    <div class="font-weight-bold">{{ ($details->trainner_name) ? $details->trainner_name : '---' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Short Description') }}</div>
                    <div class="font-weight-bold" style="height: 150px; overflow-y: scroll">{{
                        ($details->short_description) ? $details->short_description : '---'
                        }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="border-left pl-2">
                    <div class="text-gray">{{ __('lb.Description') }}</div>
                    <div class="font-weight-bold" style="height: 150px; overflow-y: scroll">{{ ($details->description) ?
                        $details->description : '---' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h5>{{ __('lb.Course Videos') }}</h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 d-flex justify-content-end" style="gap: 10px">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal" id="createButton">
                    <i class="fa fa-plus-circle"></i>
                    {{__('lb.Create')}}
                </button>
                <button class="btn btn-success" id="refreshButton"
                    onclick="refreshData('{{ route('course.get_video_details', request()->details_id) }}')">
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-sm table-bordered datatable" class="display" id='dataTable'
                    style="overflow-x: scroll" style="width: 100%;">
                    <thead class="bg-light">
                        <tr>
                            <th width="70px">{{__('lb.No.')}}</th>
                            <th>{{__('lb.English Name')}}</th>
                            <th>{{__('lb.Ordering')}}</th>
                            <th width="100">{{__('lb.Status')}}</th>
                            <th width="5">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('course_details.create')
@include('course_details.edit')

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
            ajax: "{{ route('course.get_video_details', request()->details_id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name_en', name: 'name_en'},
                {data: 'ordering', name: 'ordering'},
                {
                    data: 'status',
                    name: 'corses.status',
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
