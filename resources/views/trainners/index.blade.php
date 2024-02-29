@extends('layouts.master')

@section('page_title', __('lb.Trainner'))
@section('directory', __('lb.Trainner'))

@section('css')
<style>
    #dataTable tbody tr td:nth-child(3),
    td:nth-child(7),
    td:nth-child(8) {
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
                    onclick="disabledData('{{ route('trainner.data') }}')">
                    <i class="fa fa-exclamation-triangle"></i> {{ __('lb.Hidden') }}
                </button>
                <button class="btn btn-outline-danger" id="trushButton"
                    onclick="trushData('{{ route('trainner.data') }}')">
                    <i class="fa fa-trash"></i> {{ __('lb.Trash') }}
                </button>
                <button class="btn btn-success" id="refreshButton"
                    onclick="refreshData('{{ route('trainner.data') }}')">
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-sm table-bordered datatable" id='dataTable'
                    style="width: 100%;">
                    <thead class="bg-light">
                        <tr>
                            <th width="70px">{{__('lb.No.')}}</th>
                            <th width="40px">{{__('lb.Logo')}}</th>
                            <th>{{__('lb.Gender')}}</th>
                            <th>{{__('lb.Name')}}</th>
                            <th>{{__('lb.Phone')}}</th>
                            <th>{{__('lb.Email')}}</th>
                            <th width="100">{{__('lb.Status')}}</th>
                            <th width="100">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('trainners.create')
@include('trainners.edit')
@include('trainners.details')

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
            ajax: "{{ route('trainner.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'thumbnail', name: 'thumbnail',  searchable: false, orderable: false},
                {
                    data: 'gender',
                    name: 'gender',
                    mRender: function (data, type, row) {
                        if(data == 1){
                            return  '{{__('lb.Male')}}'
                        }else{
                            return  ' {{__('lb.Female')}}'
                        }
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'email', name: 'email'},
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
            url: "{{route('trainner.deatil')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#dname').val(res.data.trainner.name);
                $('#dyear_experience').val(res.data.trainner.year_experience);
                $('#dgender').val(res.data.trainner.gender);
                $('#demail').val(res.data.trainner.email);
                $('#dphone_number').val(res.data.trainner.phone_number);
                $('#dskills').val(res.data.trainner.skills);
                $('#ddescription').text(res.data.trainner.description);
                $('#dthumbnail_logo').attr('src', res.data.trainner.photo);
                $('#detailsModal').modal('show');
                var courses = res.data.courses;
                var tbody = $('#tableDeatail');
                tbody.empty();

                if (courses.length > 0) {
                    $.each(courses, function(index, item) {
                        var row = $('<tr>');
                        row.append($('<td>').text((item.code !== '' ) ? item.code : 'null'));
                        row.append($('<td>').text((item.name_en !== '') ? item.name_en : 'null'));
                        row.append($('<td>').text((item.name_kh !== '') ? item.name_kh : 'null'));
                            row.append($('<td>').text((item.price !== '') ? item.price + '$' : 'null'));
                        row.append($('<td>').text((item.total_hours !== '') ? item.total_hours + 'h' : 'null'));
                        tbody.append(row);
                    });
                }else{
                    var row = `
                        <tr>
                            <td colspan="5" align="center"> NO DATA </td>
                             </tr>
                    `
                    tbody.append(row);
                }
            }
        });
    }

    function editRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('trainner.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eholder').empty();
                $('#eid').val($(obj).attr('key'));
                $('#ename').val(res.data.name);
                $('#eexperience').val(res.data.year_experience);
                $('#egender').val(res.data.gender);
                $('#eemail').val(res.data.email);
                $('#enumber').val(res.data.phone_number);
                $('#eskills').val(res.data.skills);
                $('#edescription').val(res.data.description);
                $('#efilePathInput').val(res.data.photo);
                $('#eholder').append(
                    $('<img>').css({
                        'height': '100%',
                        'width': '100%',
                        'object-fit': 'cover',
                    }).attr('src', res.data.photo)
                );
                $('#estatus').val(res.data.status);
                $('#editModal').modal('show');
            }
        });
    }

</script>
@endsection
