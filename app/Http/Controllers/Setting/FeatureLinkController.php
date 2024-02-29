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

class FeatureLinkController extends BaseController
{
    protected $tbl = 'feature_links';

    public function index(Request $request) {
        if (!$request->ajax()) {
            $data['system_feature'] = SystemFeature::find(myDecrypt($request->id));
            return view('settings.feature_links.index', $data);
        }
        $data = DB::table($this->tbl)->where("feature_links.active", 1)
        ->where('feature_links.feature_id', myDecrypt($request->id))
        ->select(
            'feature_links.*',
        );
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('setting.feature_link.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.feature_link.update', $row->id, );
                return $btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
