<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Trainner;
use Exception;
use Illuminate\Database\Query\Builder;

class TrainnerController extends BaseController
{
    protected $tbl = 'trainners';

    public function index()
    {
        return view('trainners.index');
    }

    public function data(Request $request)
    {
        $status = $request->input('status', 1);
        if ($status == 'trush') {
            $data = Trainner::onlyTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_delete = $this->btn_delete('trainner.delete', $row->id);
                    $btn_restore = $this->btn_restore('trainner.restore', $row->id,);
                    return $btn_restore . ' ' . $btn_delete;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->photo;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="' . $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        } elseif ($status == 0) {
            $data = DB::table($this->tbl)->where('status', $status)->where('deleted_at', null)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_move_to_trush = $this->btn_move_to_trush('trainner.trush', $row->id);
                    $btn_show = $this->btn_show('trainner.show', $row->id,);
                    return $btn_show . ' ' . $btn_move_to_trush;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->photo;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="' . $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        } else {
            $data = DB::table($this->tbl)->where('status', $status)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_hidden = $this->btn_hidden('trainner.hidden', $row->id);
                    $btn_edit = $this->btn_edit('trainner.update', $row->id,);
                    $btn_details = $this->btn_details('trainner.deatil', $row->id,);
                    return  $btn_details .' '.  $btn_edit . ' ' . $btn_hidden;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->photo;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="' . $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        }
    }

    public function trush(Request $request){
        $id = myDecrypt($request->key);
        try {
            Trainner::find($id)->delete();
            return (object)[
                'status' => 200,
                'data' => null,
                'sms' => __('form.message.move_to_trash.success'),
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' => __('lb.Error'),
            ];
        }
    }

    public static function restore(Request $request)
    {
        $id = myDecrypt($request->key);
        try {
            Trainner::onlyTrashed()->find($id)->restore();
            return (object)[
                'status' => 200,
                'data' => null,
                'sms' => __('form.message.restore.success'),
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' => __('lb.Error'),
            ];
        }
    }

    public function deatil(Request $request){
        try {
            if(is_numeric($request->key)){
                $id = $request->key;
            }else{
                $id = myDecrypt($request->key);
            }
            $data['trainner'] = DB::table($this->tbl)->find($id);
            $data['courses'] =  DB::table($this->tbl)->join('courses', 'courses.trainner_id', '=', $this->tbl . '.id')
            ->select('courses.*')
            ->where($this->tbl . '.id', $id)
            ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
                'sms' => __('lb.Success'),
            ]);
        }catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => "Error: " . $e->getMessage(),
                'sms' => __('lb.Something went wrong! Please try again.'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        $id = myDecrypt($request->key);
        try {
            Trainner::onlyTrashed()->find($id)->forceDelete();
            return (object)[
                'status' => 200,
                'data' => null,
                'sms' => __('lb.Deleted successfully.'),
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' => __('lb.Error'),
            ];
        }
    }

}
