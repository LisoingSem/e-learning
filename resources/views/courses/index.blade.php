@extends('layouts.master')

@section('page_title', __('lb.Courses'))
@section('directory', __('lb.Courses'))

@section('css')
<style>
    tbody tr td:nth-child(3),
    td:nth-child(10),
    td:nth-child(11) {
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal" id="createButton">
                    <i class="fa fa-plus-circle"></i>
                    {{__('lb.Create')}}
                </button>
                <button class="btn btn-outline-warning" id="disableButton"
                    onclick="disabledData('{{ route('course.data') }}')">
                    <i class="fa fa-exclamation-triangle"></i> {{ __('lb.Hidden') }}
                </button>
                <button class="btn btn-outline-danger" id="trushButton"
                    onclick="trushData('{{ route('course.data') }}')">
                    <i class="fa fa-trash"></i> {{ __('lb.Trash') }}
                </button>
                <button class="btn btn-success" id="refreshButton" onclick="refreshData('{{ route('course.data') }}')">
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                {{--<div class="table-responsive">--}}
                    <table class="table table-sm table-bordered datatable" class="display" id='dataTable'
                        style="overflow-x: scroll" style="width: 100%;">
                        <thead class="bg-light">
                            <tr>
                                <th width="70px">{{__('lb.No.')}}</th>
                                <th width="40px">{{__('lb.Logo')}}</th>
                                <th>{{__('lb.Code')}}</th>
                                <th>{{__('lb.English Name')}}</th>
                                <th>{{__('lb.Course Category')}}</th>
                                <th>{{__('lb.Trainner')}}</th>
                                <th>{{__('lb.Price')}}</th>
                                <th>{{__('lb.Total Hours')}}</th>
                                <th>{{__('lb.Ordering')}}</th>
                                <th width="100">{{__('lb.Status')}}</th>
                                <th width="100">{{__('lb.Action')}}</th>
                            </tr>
                        </thead>
                    </table>
                    {{--
                </div>--}}
            </div>
        </div>
    </div>
</div>

@include('courses.create')
@include('courses.edit')

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
            ajax: "{{ route('course.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'thumbnail', name: 'thumbnail',  searchable: false, orderable: false},
                {data: 'code', name: 'code',     },
                {data: 'name_en', name: 'name_en'},
                {data: 'categories_name'},
                {data: 'trainner_name', name: 'trainner_name'},
                {
                    data: 'price',
                    name: 'courses.price',
                    render: function(data) {
                    return data + '$';
                    }
                },
                {
                    data: 'total_hours',
                    name: 'courses.total_hours',
                    render: function(data) {
                    return data + 'h';
                    }
                },
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

    function detailsRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('course.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#dcode').val(res.data.code);
                $('#dtotal_hours').val(res.data.total_hours);
                $('#dprice').val(res.data.price);
                $('#dordering').val(res.data.ordering);
                $('#dphone_number').val(res.data.phone_number);
                $('#dskills').val(res.data.skills);
                $('#ddescription').text(res.data.description);
                $('#dthumbnail_logo').attr('src', res.data.photo);
                $('#detailsModal').modal('show');
            }
        });
    }

    function updateCheckboxes(categories) {
        $('.form-check-input').prop('checked', false);

        if (categories && categories.length > 0) {
            categories.forEach(function(categoryId) {
            $('#einlineCheckbox' + categoryId).prop('checked', true); // Check the checkbox with matching category ID
            });
        }
    }

    function editRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('course.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eholder').empty();
                $('#eid').val($(obj).attr('key'));
                $('#ecode').val(res.data.code);
                $('#etotal_hours').val(res.data.total_hours);
                $('#eprice').val(res.data.price);
                $('#eordering').val(res.data.ordering);
                $('#ename_kh').val(res.data.name_kh);
                $('#ename_en').val(res.data.name_en);
                $('#enumber').val(res.data.phone_number);
                $('#estatus').val(res.data.status);
                var categories = JSON.parse(res.data.course_category_id);
                updateCheckboxes(categories);
                $('#etrainner_id').val(res.data.trainner_id);
                $('#edescription').val(res.data.description);
                $('#eshort_description').val(res.data.short_description);
                $('#efilePathInput').val(res.data.thumbnail);
                $('#eholder').append(
                    $('<img>').css({
                        'height': '100%',
                        'width': '100%',
                        'object-fit': 'cover',
                    }).attr('src', res.data.thumbnail)
                );
                $('#editModal').modal('show');
            }
        });
    }

</script>
@endsection
