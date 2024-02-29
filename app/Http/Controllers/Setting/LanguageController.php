<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use DB;
use DataTables;

class LanguageController extends BaseController
{
    protected $tbl = 'languages';
    public function index(Request $request) {
        if (!$request->ajax()) {
            return view('settings.languages.index');
        }
        $data = DB::table($this->tbl)->where("active", 1);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('setting.language.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.language.update', $row->id, );
                return $btn_edit;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
