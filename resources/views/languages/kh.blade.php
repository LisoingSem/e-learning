@extends('layouts.master')
@section('tab-title')
<title>List of Villages</title>
@endsection
@section('css')
<!-- DataTables -->
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-sm-12">
        <a href="{{route('language.greeting_create_en')}}" class="btn btn-primary">{{__('lb.Create')}}</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <td>English</td>
                            <td>Khmer</td>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal -->

@endsection

@section('js')

<script>
    $(document).ready(function(){
        // active menu 
        $("#operation_setting_menu").addClass("menu-open"); 

        // search clicked 
        $('#btn_search').click(function() {
            $('#example1').DataTable().draw(true);
        });


        // Datatable 
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "lengthChange": true,
            "bInfo": false,
            "pageLength": 100,
            "lengthMenu": [[100, 500, -1], [ 100, 500, "ទាំងអស់",]],
            // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
            "processing": true,
            "serverSide": true,
            "searching": true,
            ajax:{
                url: "{{ route('language.greeting_kh') }}",
                type: 'get',
                data: function(d){
                    d.name = $('#search_name').val()
                }
            },
            columns: [
                {
                    data: 'en_word',
                    name: 'key'
                },
                {
                    data: 'value', orderable: false,
                    mRender: function(data, type, row){
                        return `<input onchange="edit('${row.key}', this)" key="${row.key}" value="${row.value}" class="form-control editvalue">`
                    }
                    
                }
                
            ],
           
            

        })
    })

    function edit(key, thischange){
        // var Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 3000
        // });
        value = $(thischange).val();
        $.ajax({
            url: "{{route('language.greeting_kh_save')}}",
            data: {
                'key': key,
                'value': value,
                '_token': "{{csrf_token()}}"
            },
            type: 'post',
            success: function(response){
                // if(response.status = 200){
                //     Toast.fire({
                //         icon: 'success',
                //         title: 'Greeting kh saved.'
                //     })
                      
                // }else{
                //     Toast.fire({
                //         icon: 'error',
                //         title: 'Unable to get edit data!'
                //     })
                // }
            }
        });
    }

</script>
@endsection