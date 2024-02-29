<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use DB;
use DataTables;

class GroupController extends BaseController
{
    protected $tbl = 'groups';
    public function index(Request $request) {
        if (!$request->ajax()) {
            $data['countries'] = DB::table('countries')->where('active', 1)->get();
            return view('settings.groups.index', $data);
        }
        $data = DB::table($this->tbl)->where("groups.active", 1)
        ->join('countries', 'countries.id', 'groups.country_id')
        ->join('factories', 'factories.id', 'groups.factory_id')
        ->select(
            'groups.*', 
            DB::raw('concat(groups.name_kh, "(", groups.name_en, ")") as group_name'),
            DB::raw('concat(countries.name_kh, "(", countries.name_en, ")") as country_name'),
            DB::raw('concat(factories.name_kh, "(", factories.name_en, ")") as factory_name')
        );
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('setting.group.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.group.update', $row->id, );
                return  $btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit(Request $request){
        try {
            $id = myDecrypt($request->key);
            $group= DB::table($this->tbl)->find($id);
            $data['factories'] = DB::table('factories')->where('country_id', $group->country_id)->where('active', 1)->get();
            $data['group'] = $group;
            return response()->json([
                'status' => 200,
                'data' => $data,
                'sms' => 'ជោគជ័យ',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => "Error: " . $e->getMessage(),
                'sms' => 'មានកំហុសអ្វីមួួយ! សូមព្យាយាមម្ដងទៀត។',
            ]);
        }
    }

    public function getAllGroup(Request $request){
        $data = DB::table('groups')->where('groups.active', 1)
        ->join('factories', 'factories.id', 'groups.factory_id')
        ->select(
            'groups.*', 
            'factories.name_kh as factory_name'
        );
        if($request->search_group){
            $search = $request->search_group;
            $data->where(function ($query) use ($search) {
                $query->where('groups.name_kh', 'LIKE', "%$search%")
                ->orWhere('groups.name_en', 'LIKE', "%$search%")
                ->orWhere('factories.name_kh', 'LIKE', "%$search%")
                ->orWhere('factories.name_en', 'LIKE', "%$search%");
            });
        }

        $data = $data->limit(20)
        ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
            'sms' => 'success',
        ]);
    }

    public function getGroupByCountry(Request $request){
        if($request->key){
            $id = myDecrypt($request->key);
            $worker_factory = DB::table('worker_factories')->where('worker_id', $id)->where('is_current', 1)->first();
            if($worker_factory){
                $data = DB::table('groups')->where('groups.active', 1)->join('factories', 'factories.id', 'groups.factory_id')->select('groups.*', 'factories.name_kh as factory_name')->where('groups.country_id', $worker_factory->country_id)->get();
                return response()->json([
                    'status' => 200,
                    'data' => ['groups' => $data, 'worker_factory' => $worker_factory],
                    'sms' => 'success',
                ]);
            }else{
                return response()->json([
                    'status' => 500,
                    'data' => null,
                    'sms' => __('lb.Please add factory for this worker'),
                ]);
            }
        }else{
            $data = DB::table('groups')->where('groups.active', 1)
            ->join('factories', 'factories.id', 'groups.factory_id')
            ->select('groups.*', 'factories.name_kh as factory_name')
            ->where('groups.country_id', $request->country_id)
            ->where('groups.factory_id', $request->factory_id)
            ->get();
            return response()->json([
                'status' => 200,
                'data' => $data,
                'sms' => 'success',
            ]);
        }
        
       
    }

}
