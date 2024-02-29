<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use DB;
use DataTables;

class SystemController extends BaseController
{
    protected $tbl = 'systems';
    public function index(Request $request) {
        if (!$request->ajax()) {
            return view('settings.systems.index');
        }
        $data = DB::table($this->tbl)->where("active", 1);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('icon', function ($row) {
                return '<img src="'.showFile($row->icon??"").'" width="50">';
            })
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('setting.system.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.system.update', $row->id, );
                return $btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action', 'icon'])
            ->make(true);
    }
    public function save(Request $request){
        try{
            $data = $request->except('_token','icon', 'id');
            if($request->hasFile('icon')){
                $file = $request->file('icon');
                $path = 'icons';
                $data['icon'] = storeFile($file, $path);
            }
            $res = BaseModel::saveData($this->tbl, $data);
            return $res;
        }catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => "Error: " . $e->getMessage(),
                'sms' => 'មានកំហុសអ្វីមួួយ! សូមព្យាយាមម្ដងទៀត។',
            ]);
        }
    }

    public function update(Request $request){
        try{
            $data = $request->except('_token','icon', 'id');
            if($request->hasFile('icon')){
                $file = $request->file('icon');
                $path = 'icons';
                $data['icon'] = storeFile($file, $path);
            }
            $res = BaseModel::updateData($this->tbl, myDecrypt($request->id), $data);
            return $res;
        }catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => "Error: " . $e->getMessage(),
                'sms' => 'មានកំហុសអ្វីមួួយ! សូមព្យាយាមម្ដងទៀត។',
            ]);
        }
    }

}
