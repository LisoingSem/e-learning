<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileAccessController extends Controller
{
    public function serve(Request $request)
    {
        try{
            // if(!auth()->check()){
            //     return abort('404');
            // }
            if(file_exists(storage_path('app'.str_replace('getfile', '', $request->path())))){
                return response()->file(storage_path('app'.str_replace('getfile', '', $request->path())));
            }else{
                return abort('404');
            }
        }catch(Exception $e){
            return abort('404');
        }
    }
}
