<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use App\Models\Settings\System;
use App\Models\BaseModel;
use DB;
use DataTables;

class RoleController extends BaseController
{
    protected $tbl = 'roles';
    public function index(Request $request) {
        if (!$request->ajax()) {
            return view('settings.roles.index');
        }
        $data = DB::table($this->tbl)->where("active", 1);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_delete = '';
                if($row->id != 4){
                    $btn_delete = $this->btn_delete('setting.role.delete', $row->id);
                }
                $btn_edit = $this->btn_edit('setting.role.update', $row->id, );
                $permission_route = route('setting.role_permission.index', myEncrypt($row->id));
                $btn_permission = '<a href="'.$permission_route.'" class="btn btn-sm btn-warning text-white"><i class="fa fa-key"></i></a>';
                return $btn_permission . ' ' .$btn_edit .' '.$btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function permission(Request $request, $id){
        $data['role_id'] = $id;
        $data['role'] = DB::table('roles')->find(myDecrypt($id));
        $data['systems'] = DB::table('systems')->where('active', 1)->get();
        // return in_array(5, explode(",", $role->permission));
            $data['mudules'] = DB::table('systems')
            ->join('system_modules', 'system_modules.system_id', 'systems.id')
            ->where('system_modules.active', 1)
            ->where('systems.active', 1)
            ->select(
                'system_modules.id',
                'system_modules.name',
                'systems.id as system_id',
                'systems.name as system_name'
            )->orderBy('systems.id')->get();
        return view('settings.roles.permission', $data);
    }

    public function savePermission(Request $request){
        try{
            $data = $request->except('_token', 'id');
            $res = BaseModel::updateData($this->tbl, myDecrypt($request->id), $data);
            return $res;
        }catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => "Error: " . $e->getMessage(),
                'sms' => 'មានកំហុសអ្វីមួយ! សូមព្យាយាមម្ដងទៀត។',
            ]);
        }

    }

}
