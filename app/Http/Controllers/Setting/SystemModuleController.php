<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Settings\System;
use App\Models\Settings\SystemModule;
use DB;
use DataTables;

class SystemModuleController extends BaseController
{
    protected $tbl = 'system_modules';

    public function index(Request $request) {
        if (!$request->ajax()) {
            $data['systems'] = System::where('active', 1)->get();
            return view('settings.system_modules.index', $data);
        }
        $data = DB::table($this->tbl)
        ->join('systems', 'system_modules.system_id', 'systems.id')
        ->where("system_modules.active", 1)
        ->select(
            'systems.name as system_name',
            'system_modules.*',
        );
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('setting.system_module.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.system_module.update', $row->id);

                $btn_feature_route = route('setting.system_feature.index', myEncrypt($row->id));
                $btn_feature = '<a href="'.$btn_feature_route.'" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>';
                return $btn_feature . ' ' .$btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
