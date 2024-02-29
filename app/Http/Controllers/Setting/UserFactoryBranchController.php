<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use DB;
use DataTables;

class UserFactoryBranchController extends BaseController
{
    protected $tbl = 'user_factory_branches';
    public function index(Request $request) {
        if (!$request->ajax()) {
            $data['factories'] = DB::table('factories')->where('active', 1)->get();
            return view('settings.user_factory_branches.index', $data);
        }
        $data = DB::table($this->tbl)->where("user_factory_branches.active", 1)
        ->join('users', 'user_factory_branches.user_id', 'users.id')
        ->join('factory_branches', 'factory_branches.id', 'user_factory_branches.factory_branch_id')
        ->join('factories', 'factories.id', 'factory_branches.factory_id')
        ->select(
            'user_factory_branches.id',
            'factory_branches.name_kh as branch_name',
            'factories.name_kh as factory_name',
        );
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = $this->btn_delete('agency.delete', $row->id);
                $btn_edit = $this->btn_edit('agency.update', $row->id, );
                return $btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
