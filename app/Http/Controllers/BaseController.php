<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseModel;
use DB;
use Auth;
use Storage;

class BaseController extends Controller
{
    public function save(Request $request){
        $data = $request->except('_token');
        $res = BaseModel::saveData($this->tbl, $data);
        return $res;
    }

    public function edit(Request $request){
        try {
            if(is_numeric($request->key)){
                $id = $request->key;
            }else{
                $id = myDecrypt($request->key);
            }
            $data = DB::table($this->tbl)->find($id);
            return response()->json([
                'status' => 200,
                'data' => $data,
                'sms' => __('lb.Success'),
            ]);
        }catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => "Error: " . $e->getMessage(),
                'sms' => __('form.message.error'),
            ]);
        }
    }

    public function update(Request $request){
        $data = $request->except('_token', 'id');
        $res = BaseModel::updateData($this->tbl, myDecrypt($request->id), $data);
        return $res;
    }

    public function delete(Request $request){
        $res = BaseModel::deleteData($this->tbl, myDecrypt($request->key));
        return $res;
    }

    public function hidden(Request $request){
        $res = BaseModel::hiddenData($this->tbl, myDecrypt($request->key));
        return $res;
    }

    public function show(Request $request){
        $res = BaseModel::showData($this->tbl, myDecrypt($request->key));
        return $res;
    }

}


