@extends('layouts.master')
@section('page_title', __('lb.Groups'))
@section('directory', __('lb.Groups'))
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
                            <th>{{__('lb.Group Name')}}</th>
                            <th>{{__('lb.Country')}}</th>
                            <th>{{__('lb.Factory')}}</th>
                            <th>{{__('lb.Departure Date')}}</th>
                            <th>{{__('lb.Address')}}</th>
                            <th width="250">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.groups.create')
@include('settings.groups.edit')
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
            ajax: "{{ route('setting.group.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'group_name', name: 'groups.name_kh'},
                {data: 'country_name', name: 'coutries.name_kh'},
                {data: 'factory_name', name: 'factories.name_kh'},
                {
                    data: 'departure_date', 
                    name: 'groups.departure_date',
                    width: 110,
                    mRender: function (data, type, row) {
                        return  moment(data).format('DD/MM/YYYY');
                    }
                },
                {data: 'address', name: 'groups.address'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    width: 80
                },
            ]
        });
    });

    function editRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('setting.group.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                console.log(res);
                $('#eid').val($(obj).attr('key'));
                $('#ename_en').val(res.data.group.name_en);
                $('#ename_kh').val(res.data.group.name_kh);
                $('#edeparture_date').val(res.data.group.departure_date);
                $('#eaddress').val(res.data.group.address);
                $('#ecountry_id').val(res.data.group.country_id);

                let options = '<option value="">-----</option>';
                res.data.factories.map((data, index) =>{
                    options += `<option value="${data.id}">${data.name_kh}</option>`;
                })
                $('#efactory_id').html(options);

                setTimeout(() => {
                    $('#efactory_id').val(res.data.group.factory_id);
                }, 100);
                $('#editModal').modal('show');
            }
        });
    }


    function getFactory(){
        let id = $('#country_id').val();
        $.ajax({
            type: 'GET',
            url: "{{route('setting.factory.by_country')}}",
            data: {'id': id},
            success: function(res)
            {
               let options = '<option value="">-----</option>';
               res.data.map((data, index) =>{
                options += `<option value="${data.id}">${data.name_kh}</option>`;
               })
               $('#factory_id').html(options);
            }
        });
    }
    
</script>
@endsection
