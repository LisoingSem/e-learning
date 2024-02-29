@extends('layouts.master')
@section('page_title', __('lb.Expense Report'))
@section('directory', __('lb.Expense Report'))
@section('css')
    <style>
        @media print {
            .printHide{
                display: none !important;
            }
            @page {
                size: auto;
            }
            *{
                margin: 0px !important;
                padding: 0px !important;
                /* background-color: transparent !important;	 */
            }
            table, td, th {
                padding: 5px !important;
                border: 1px solid !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            .bg_header th{
                background-color: #0094d0 !important;
            }
            .bg_footer td{
                background-color: #b8dafe !important;
            }
        }

        table, td, th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        .bg_header{
            background-color: #0094d0;
        }
        .bg_footer{
            background-color: #b8dafe;
        }
    </style>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form action="">
        <div class="row mb-3 printHide" >
            <div class="col-sm-2">
                <label>{{__('lb.Start Date')}}</label>
                <input type="date" name="start_date" value="{{isset(request()->start_date)?(request()->start_date):$start_date}}" class="form-control" required>
            </div>
            <div class="col-sm-2">
                <label>{{__('lb.End Date')}}</label>
                <input type="date" name="end_date" value="{{isset(request()->end_date)?(request()->end_date):$end_date}}" class="form-control" required>
            </div>
            <div class="col-sm-3">
                <br>
                <button id="btn_search" class="btn btn-primary mt-2"><i class="fa fa-search"></i> {{__('lb.Show')}}</button>
                <button type="button" id="btn_print" onclick="window.print()" class="btn btn-info mt-2"><i class="fa fa-print"></i> {{__('lb.Print')}}</button>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-sm-12 text-center">
                <h5>{{__('lb.Expense Report')}}</h5>
                <h6>{{__('lb.From date')}} {{Carbon\Carbon::parse($start_date)->format('d/m/Y')}} {{__('lb.To date')}} {{Carbon\Carbon::parse($end_date)->format('d/m/Y')}}</h6>
            </div>
        </div>
       <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr class="bg_header">
                                <th width="30" >{{__('lb.No.')}}</th>
                                <th width="80">{{__('lb.Date')}}</th>
                                <th>{{__('lb.Reference')}}</th>
                                <th>{{__('lb.Person in Charge')}}</th>
                                <th>{{__('lb.Note')}}</th>
                                <th>{{__('lb.Amount')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($expenses as $k => $ex)
                                <tr>
                                    <td class="text-center">{{$k+1}}</td>
                                    <td>{{Carbon\Carbon::parse($ex->created_at)->format('d/m/Y')}}</td>
                                    <td>{{$ex->reference}}</td>
                                    <td>{{$ex->person_in_charge}}</td>
                                    <td>{{$ex->note}}</td>
                                    <td>${{numberFormat($ex->amount)}}</td>
                                </tr>
                                @php $total += $ex->amount; @endphp
                            @endforeach
                            <tr class="bg_footer">
                                <td colspan="5" style="text-align: right !important">{{__('lb.Total')}}</td>
                                <td>${{numberFormat($total)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
       </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#report_menu").addClass("menu-open"); 
    });
</script>
@endsection
