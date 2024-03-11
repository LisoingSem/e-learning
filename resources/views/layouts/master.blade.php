<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title') | {{ config('app.name') }} </title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png')}}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.min.css') }}">


    <!-- custom css  -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/report.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css"> -->

    <style>
            /* Ensure that the demo table scrolls */
    #dataTable th, #dataTable td { white-space: nowrap;}
    /* div.dataTables_wrapper {
        margin: 0 auto;
    } */

    .bootstrap-select .dropdown-toggle .filter-option-inner-inner{
        color: #495057 !important;
    }

    .bootstrap-select>.dropdown-toggle{
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    div.dataTables_wrapper div.dataTables_length select{
        width: 60px;
        font-size: 15px;
    }

    .dataTables_scroll
    {
        overflow:auto;
    }

        thead tr th{
            white-space: nowrap;
        }

    .dataTables_wrapper .row:nth-child(2) {
        overflow-y: scroll;
    }


    .custom{
        height: 80px !important;
        overflow-y: scroll !important;
        top: -3px !important;
    }

    </style>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed khmer_battambang">
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')

        <div class="content-wrapper">
            <section class="content pt-1">
                <div class="container-fluid">
                    <div class="row">
                        @yield('header')
                    </div>
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title info" id="confirmModalLabel">Comfirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="confirmModalContent">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_confirm_no">ទេ</button>
                <button type="button" class="btn btn-primary" id="btn_confirm_yes">យល់ព្រម</button>
            </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script> -->
    <!-- <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script> -->
    <!-- <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script> -->
    <!-- <script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
    <!-- <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script> -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> -->
    <!-- <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script> -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('lte/dist/js/adminlte.js?v=3.2.0') }}"></script>
    <!-- toastr  -->
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
    <!-- custom js  -->
    <script src="{{ asset('js/base.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>

    <!-- DataTables -->
    <script src="{{asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"> -->

    @yield('script')
    @yield('js')

    <script>

        function confirmDailog(data_confirm) {
            $('#confirmModalLabel').html(data_confirm.title);
            $('#confirmModalContent').html(data_confirm.content);
            $('#btn_confirm_no').html(data_confirm.no);
            $('#btn_confirm_yes').html(data_confirm.yes);

            $('#confirmModal').modal('show');
            $('#btn_confirm_yes').off('click');

            $('#btn_confirm_yes').click(function() {
                $('#confirmModal').modal('hide');
                data_confirm.call_back();
            });
        }

        function showNotifyMessage(type, sms){
            myMsg.notify(type, sms);
        }
        // for action with rediretion
        @if(session()->has('success'))
            showNotifyMessage('Success', "{{session()->get('success')}}");
        @endif
        @if(session()->has('error'))
            showNotifyMessage('error', "{{session()->get('error')}}");
        @endif
    </script>
</body>
</html>
