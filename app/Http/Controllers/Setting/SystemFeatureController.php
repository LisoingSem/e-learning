<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Settings\System;
use App\Models\Settings\SystemModule;
use App\Models\Settings\SystemFeature;
use DB;
use DataTables;

class SystemFeatureController extends BaseController
{
    protected $tbl = 'system_features';

    public function index(Request $request) {
        if (!$request->ajax()) {
            $data['system_module'] = SystemModule::find(myDecrypt($request->id));
            return view('settings.system_features.index', $data);
        }
        $data = DB::table($this->tbl)->where("system_features.active", 1)
        ->join('system_modules', 'system_modules.id', 'system_features.module_id')
        ->join('systems', 'system_modules.system_id', 'systems.id')
        ->where('system_features.module_id', myDecrypt($request->id))
        ->select(
            'system_features.*',
        );
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('setting.system_feature.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.system_featrue.update', $row->id, );
                $feature_link_route = route('setting.feature_link.index', myEncrypt($row->id));
                $feature_link = '<a href="'.$feature_link_route.'" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>';
                return $feature_link . ' ' .$btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
