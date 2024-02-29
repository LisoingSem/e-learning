<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Settings\System;
use App\Models\Settings\SystemModule;
use App\Models\User;
use App\Models\BaseModel;
use DB;
use DataTables;

class UserController extends BaseController
{
    protected $tbl = 'users';

    public function index(Request $request) {
        if (!$request->ajax()) {
            $data['roles'] = DB::table('roles')->where('active', 1)->get();
            return view('settings.users.index', $data);
        }
        $data = DB::table($this->tbl)
        ->join('roles', 'roles.id', 'users.role_id')
        ->where("users.active", 1)
        ->select(
            'users.id',
            'users.role_id',
            'users.name',
            'users.username',
            'users.email',
            'roles.name as role_name_en',
            'roles.name_kh as role_name_kh'
        );
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_branch = '';
                $btn_delete = $this->btn_delete('setting.user.delete', $row->id);
                $btn_edit = $this->btn_edit('setting.user.update', $row->id);
                if($row->role_id == 4){
                    $btn_branch = '<a href="'.route('setting.user_factory_branch.index', $row->id).'" class="btn btn-primary btn-sm">'.__('lb.Branch').'</a>';
                }
                return $btn_branch .' '. $btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(Request $request){
        // check if exist
        $exist1 = DB::table($this->tbl)->where('username', $request->username)->where('active', 1)->count();
        if($exist1){
            return response()->json([
                'status' => 500,
                'data' => null,
                'sms' => __('Username already exist')
            ]);
        }

        $data = $request->except('_token', 'password');
        $data['password'] = bcrypt($request->password);
        $res = BaseModel::saveData($this->tbl, $data);
        return $res;
       
    }

    public function update(Request $request){
        $user = User::find(myDecrypt($request->id));
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->role_id = ($request->role_id);
        if($user->save()){
            return response()->json([
                'status' => 200,
                'data' => null,
                'sms' => 'បានបច្ចុប្បន្នភាពដោយជោគជ័យ។',
            ]);
        }
    }
}
