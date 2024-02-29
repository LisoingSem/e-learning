<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use DB;


class AuthController extends BaseApiController
{
    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('Worker#C23App')->accessToken; 
            $success['user'] =  $user;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function validation(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['status'] = 1;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            $success['status'] = 0;
            return $this->sendResponse($success, 'Exist username and password is not valid.');
        } 
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required'
        ]);

        if($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            // return $this->sendError('Old password and new password is not valid', ['error'=>$errorMessage], 403);

            return $this->sendError($request->new_password, ['error'=>$errorMessage], 403);
        }

        $auth = Auth::user();
        $user = DB::table('users')
                ->select('users.id', 'users.name', 'users.email', 'users.email_verified_at', 'users.username', 'users.role_id', 
                    'users.sex', 'users.dob', 'users.address', 
                    'users.created_at', 'users.updated_at', 'users.active')
                ->where('users.id', $auth->id)
                ->where('users.active', 1)
                ->first();
 
        // The passwords matches
        if ((Hash::check(request('password'), Auth::user()->password)) == false) {
            return $this->sendError('Exist username and password is not valid', ['error'=>'Not Found']);
        }

        DB::table('users')
            ->where('users.id', $auth->id)
            ->update([
                'users.password' => Hash::make($request->new_password)
            ]);

        return $this->sendResponse($user, 'User has been change password successfully.');
    }

    public function changeProfile(Request $request)
    {
        $updateData = [
            'users.name' =>  $request->name,
            'users.sex' =>  $request->sex,
            'users.dob' =>  $request->dob,
            'users.phone_number' =>  $request->phone_number,
            'users.address' =>  $request->address
        ];

        if($request->has('photo')) {
            $updateData['users.photo'] = $request->photo;
        }

        $result = DB::table('users')
                    ->where('users.id', $request->id)
                    ->update($updateData);

        $userData = DB::table('users')
                ->select('users.id', 'users.name', 'users.email', 'users.email_verified_at', 'users.username', 'users.role_id', 
                    'users.sex', 'users.dob', 'users.address', 'users.photo', 
                    'users.created_at', 'users.updated_at', 'users.active')
                ->where('users.id', $request->id)
                ->first();

        return $this->sendResponse($userData, 'User has been change password successfully.');
    }
}
