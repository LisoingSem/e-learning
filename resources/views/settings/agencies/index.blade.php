@extends('layouts.master')
@section('page_title', __('lb.Agencies'))
@section('directory', __('lb.Agencies'))
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
                            <th width="20">{{__('lb.Logo')}}</th>
                            <th>{{__('lb.Khmer Name')}}</th>
                            <th>{{__('lb.English Name')}}</th>
                            <th>{{__('lb.Registration Number')}}</th>
                            <th>{{__('lb.Registration Date')}}</th>
                            <th>{{__('lb.Phone Number')}}</th>
                            <th width="70">{{__('lb.Action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
       </div>
    </div>
</div>
@include('settings.agencies.create')
@include('settings.agencies.edit')
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
            ajax: "{{ route('agency.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'logo', name: 'logo',  searchable: false, orderable: false},
                {data: 'name_kh', name: 'name_kh'},
                {data: 'name_en', name: 'name_en'},
                {data: 'registration_no', name: 'registration_no'},
                {data: 'registration_date', name: 'registration_date'},
                {data: 'phone_number', name: 'phone_number'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });


        $("#logo").change(function() {
            showImage(this);
        });
        $("#elogo").change(function() {
            showEditImage(this);
        });
    });

    function editRow(obj){
        $.ajax({
            type: 'GET',
            url: "{{route('agency.edit')}}",
            data: {
                key: $(obj).attr('key'),
            },
            success: function(res)
            {
                $('#eid').val($(obj).attr('key'));
                $('#ename_en').val(res.data.agency.name_en);
                $('#ename_kh').val(res.data.agency.name_kh);
                $('#eaddress').val(res.data.agency.address);
                $('#ephone_number').val(res.data.agency.phone_number);
                $('#eregistration_no').val(res.data.agency.registration_no);
                $('#eregistration_date').val(res.data.agency.registration_date);
                $('#eagency_logo').attr('src', res.data.logo);
                $('#editModal').modal('show');
            }
        });
    }

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#agency_logo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function showEditImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#eagency_logo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
