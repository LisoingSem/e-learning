@extends('layouts.master')
@section('page_title', __('lb.Home'))
@section('content')
<div class="mt-3">
    <h1>Dashboard</h1>

    {{--<div>
        <form class="row mb-3">
            <div class="col-sm-3">
                <label>{{__('lb.Country')}}</label>
                <select onchange="getFactory(this)" name="country" id="country_id" class="form-control">
                    <option value="">----</option>
                    @foreach ($countries as $country)
                        <option @if(isset(request()->country) && request()->country == $country->id) selected @endif value="{{$country->id}}">{{$country->name_kh}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label>{{__('lb.Factory')}}</label>
                <select onchange="getFactoryBranch(this)" name="factory" id="factory_id" class="form-control">
                    <option value="">----</option>
                    @if(isset(request()->country))
                        <?php $factories = DB::table('factories')->where('active', 1)->where('country_id', request()->country)->get(); ?>
                        @foreach ($factories as $factory)
                        <option @if(isset(request()->factory) && request()->factory == $factory->id) selected @endif value="{{$factory->id}}">{{$factory->name_kh}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-sm-3">
                <label>{{__('lb.Branch')}}</label>
                <select name="branch" id="factory_branch_id" class="form-control">
                    <option value="">----</option>
                    @if(isset(request()->factory))
                        <?php $branches = DB::table('factory_branches')->where('active', 1)->where('factory_id', request()->factory)->get(); ?>
                        @foreach ($branches as $branch)
                        <option @if(isset(request()->branch) && request()->branch == $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name_kh}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-sm-3">
               <br>
                <button class="btn btn-primary mt-2"><i class="fa fa-filter"></i> {{__('lb.Filter')}}</button>
            </div>
        </form>
        <div class="row mb-3">
            <div class="col-sm-4 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{$total_all}}</h3>
                        <p>{{__('lb.Total Workers')}}</p>
                    </div>
                    <div class="icon ">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{$total_pending}}</h3>
                        <p>{{__('lb.Total Pending Workers')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-box"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{$total_preparing}}</h3>
                        <p>{{__('lb.Total Preparing Document')}}</p>
                    </div>
                    <div class="icon ">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{$total_ready}}</h3>
                        <p>{{__('lb.Total Get Redy')}}</p>
                    </div>
                    <div class="icon ">
                    <i class="fas fa-user-tag"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{$total_delay}}</h3>
                        <p>{{__('lb.Total Delayed')}}</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-user-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{$total_reach}}</h3>
                        <p>{{__('lb.Total Reach the Destination')}}</p>
                    </div>
                    <div class="icon ">
                    <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $("#organization_id").select2({
        theme: 'bootstrap4',
        dropdownParent: $('#createtModal')
    });
    $("#eorganization_id").select2({
        theme: 'bootstrap4',
        dropdownParent: $('#editModal')
    });
});

</script>
@endsection
