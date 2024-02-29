<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;



class ProfileController extends Controller
{
    public function profile(){
        $data['user'] = DB::table('users')
        ->join('employees', 'employees.id', 'users.employee_id')
        ->join('genders', 'genders.id', 'employees.gender_id')
        ->join('positions', 'positions.id', 'employees.position_id')
        ->leftJoin('roles', 'roles.id', 'users.role_id')
        ->select(
            'employees.kh',
            'employees.en',
            'roles.name_kh as role_name_kh',
            'roles.name as role_name_en',
            'genders.kh as gender',
            'positions.kh as position',
        )->where('users.id', auth()->user()->id)
        ->first();
        return view('auth.profile', $data);
    }

    public function changePassword(){
        return view('auth.change_password');
    }

    public function saveChangePassword(Request $request){
        if($request->password != $request->re_password){
            return redirect()->back()->with('error', 'ការផ្ទៀងផ្ទាត់លេខសម្ងាត់មិនត្រឹមត្រូវ!');
        }else{
            $user = User::find(auth()->user()->id);
            $user->password = bcrypt($request->password);
            if($user->save()){
                return redirect()->back()->with('success', 'លេខសម្ងាត់ត្រូវបានផ្លាស់ប្ដូរដោយជោគជ័យ!');
            }else{
                return redirect()->back()->with('error', 'មានកំហុស! សូមព្យាយាមម្ដងទៀត។');
            }
        }
    }

}