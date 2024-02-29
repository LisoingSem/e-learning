<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use DB;
use Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        //$data['countries'] = DB::table('countries')->where('active', 1)->get();

        //$total_all          = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1);
        //$total_pending      = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 1);
        //$total_preparing    = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 2);
        //$total_ready        = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 3);
        //$total_delay        = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 4);
        //$total_reach        = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 5);

        //if($request->country){
        //    $country_id = $request->country;

        //    $total_all->where(function ($query) use ($country_id) {
        //        $query->where('worker_factories.country_id', $country_id);
        //    });
        //    $total_pending->where(function ($query) use ($country_id) {
        //        $query->where('worker_factories.country_id', $country_id);
        //    });
        //    $total_preparing->where(function ($query) use ($country_id) {
        //        $query->where('worker_factories.country_id', $country_id);
        //    });
        //    $total_ready->where(function ($query) use ($country_id) {
        //        $query->where('worker_factories.country_id', $country_id);
        //    });
        //    $total_reach->where(function ($query) use ($country_id) {
        //        $query->where('worker_factories.country_id', $country_id);
        //    });
        //}
        //if($request->factory){
        //    $factory_id = $request->factory;
        //    $total_all->where(function ($query) use ($factory_id) {
        //        $query->where('worker_factories.factory_id', $factory_id);
        //    });
        //    $total_pending->where(function ($query) use ($factory_id) {
        //        $query->where('worker_factories.factory_id', $factory_id);
        //    });
        //    $total_preparing->where(function ($query) use ($factory_id) {
        //        $query->where('worker_factories.factory_id', $factory_id);
        //    });
        //    $total_ready->where(function ($query) use ($factory_id) {
        //        $query->where('worker_factories.factory_id', $factory_id);
        //    });
        //    $total_delay->where(function ($query) use ($factory_id) {
        //        $query->where('worker_factories.factory_id', $factory_id);
        //    });
        //    $total_reach->where(function ($query) use ($factory_id) {
        //        $query->where('worker_factories.factory_id', $factory_id);
        //    });
        //}
        //if($request->branch){
        //    $branch_id = $request->branch;
        //    $total_all->where(function ($query) use ($branch_id) {
        //        $query->where('worker_factories.factory_branch_id', $branch_id);
        //    });
        //    $total_pending->where(function ($query) use ($branch_id) {
        //        $query->where('worker_factories.factory_branch_id', $branch_id);
        //    });
        //    $total_preparing->where(function ($query) use ($branch_id) {
        //        $query->where('worker_factories.factory_branch_id', $branch_id);
        //    });
        //    $total_ready->where(function ($query) use ($branch_id) {
        //        $query->where('worker_factories.factory_branch_id', $branch_id);
        //    });
        //    $total_delay->where(function ($query) use ($branch_id) {
        //        $query->where('worker_factories.factory_branch_id', $branch_id);
        //    });
        //    $total_reach->where(function ($query) use ($branch_id) {
        //        $query->where('worker_factories.factory_branch_id', $branch_id);
        //    });
        //}

        //$data['total_all']          = $total_all->distinct('workers.id')->count();
        //$data['total_pending']      = $total_pending->distinct('workers.id')->count();
        //$data['total_preparing']    = $total_preparing->distinct('workers.id')->count();
        //$data['total_ready']        = $total_ready->distinct('workers.id')->count();
        //$data['total_delay']        = $total_delay->distinct('workers.id')->count();
        //$data['total_reach']        = $total_reach->distinct('workers.id')->count();

        return view('home');
    }





}
