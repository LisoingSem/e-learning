<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Worker;
use App\Models\Settings\System;
use Carbon\Carbon;
use DB;
use DataTables;

class MobileScreenController extends BaseController
{
    protected $tbl = 'workers';
    public function resume($id){
        $data['worker'] = DB::table('workers')
        ->leftJoin('degrees', 'degrees.id', 'workers.degree_id')
        ->select(
            'workers.*',
            'degrees.name_kh as degree_kh',
            'degrees.name_en as degree_en',
        )
        ->where('workers.id', $id)
        ->first();
        $data['parent'] = DB::table('worker_parents')
        ->leftJoin('villages', 'villages.id', 'worker_parents.village_id')
        ->leftJoin('communes', 'communes.id', 'worker_parents.commune_id')
        ->leftJoin('districts', 'districts.id', 'worker_parents.district_id')
        ->leftJoin('provinces', 'provinces.id', 'worker_parents.province_id')
        ->where('worker_id', $data['worker']->id)
        ->select(
            'worker_parents.*', 
            'villages.name_kh as village_kh',
            'villages.name_en as village_en',
            'communes.name_kh as commune_kh',
            'communes.name_en as commune_en',
            'districts.name_kh as district_kh',
            'districts.name_en as district_en',
            'provinces.name_kh as province_kh',
            'provinces.name_en as province_en'
        )
        ->first();
        $data['spouse'] = DB::table('worker_couples')
        ->leftJoin('villages', 'villages.id', 'worker_couples.village_id')
        ->leftJoin('communes', 'communes.id', 'worker_couples.commune_id')
        ->leftJoin('districts', 'districts.id', 'worker_couples.district_id')
        ->leftJoin('provinces', 'provinces.id', 'worker_couples.province_id')
        ->select(
            'worker_couples.*', 
            'villages.name_kh as village_kh',
            'villages.name_en as village_en',
            'communes.name_kh as commune_kh',
            'communes.name_en as commune_en',
            'districts.name_kh as district_kh',
            'districts.name_en as district_en',
            'provinces.name_kh as province_kh',
            'provinces.name_en as province_en'
        )
        ->where('worker_id', $data['worker']->id)->first();

        $data['factories'] = DB::table('worker_factories')
        ->join('countries', 'countries.id', 'worker_factories.country_id')
        ->join('factories', 'factories.id', 'worker_factories.factory_id')
        ->join('factory_branches', 'factory_branches.id', 'worker_factories.factory_branch_id')
        ->join('sectors', 'sectors.id', 'factory_branches.sector_id')
        ->select(
            'factory_branches.employer_name',
            'factory_branches.address',
            'worker_factories.start_date',
            'worker_factories.end_date',
            'worker_factories.contract_length',
            'worker_factories.is_countinue',
            'worker_factories.address as oversea_address',
            'factories.phone_number',
            'factories.email',
            'factories.name_kh as factory_kh',
            'factories.name_en as factory_en',
            'countries.name_kh as country_kh',
            'countries.name_en as country_en',
            'sectors.name_kh as sector_kh',
            'sectors.name_en as sector_en'
        )
        ->where('worker_id', $data['worker']->id)
        ->orderBy('worker_factories.id', 'desc')
        ->get();
        
        $data['documents'] = DB::table('worker_documents')->where('active', 1)->where('worker_id', $data['worker']->id)->get();
        $data['languages'] = DB::table('languages')
        ->leftJoin('worker_languages', 'languages.id', 'worker_languages.language_id')
        ->select(
            'languages.name_kh',
            'languages.name_en',
        )
        ->where('worker_languages.active', 1)
        ->where('worker_id', $data['worker']->id)->get();
        return view('mobile_screens.resume', $data);
    }

}
