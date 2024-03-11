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
                    $actions = '';
                    $url_restore = route('trainner.restore');
                    $url_delete = route('trainner.delete');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;"  href="'.route('trainner.details', $row->id).'"><i class="mr-2 fa fa-info-circle text-info"></i> '. __("lb.Details").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="'.myEncrypt($row->id).'" href="#"><i class="mr-2 fa fa-edit text-warning"></i> '. __("lb.Edit").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="restoreRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_restore.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-recycle text-info"></i> '. __("lb.Restore").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="deleteRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_delete.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> '. __("lb.Delete").'</a>';
                        return $this->dropdownAction($actions);
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
                    $actions = '';
                    $url_show = route('trainner.show');
                    $url_trash = route('trainner.trush');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;"  href="'.route('trainner.details', $row->id).'"><i class="mr-2 fa fa-info-circle text-info"></i> '. __("lb.Details").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="' . myEncrypt($row->id) . '" href="#"><i class="mr-2 fa fa-edit text-warning"></i> ' . __("lb.Edit") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="showRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_show . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-recycle text-info  "></i> ' . __("lb.Enable") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="moveTrushRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_trash . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> ' . __("lb.Move Trash") . '</a>';
                    return $this->dropdownAction($actions);
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
            $data = DB::table($this->tbl)->where('trainners.status', $status)->whereNull('trainners.deleted_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_hidden = route('trainner.hidden');
                    $url_trash = route('trainner.trush');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;"  href="'.route('trainner.details', $row->id).'"><i class="mr-2 fa fa-info-circle text-info"></i> '. __("lb.Details").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="' . myEncrypt($row->id) . '" href="#"><i class="mr-2 fa fa-edit text-warning"></i> ' . __("lb.Edit") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="hiddenRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_hidden . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-exclamation-triangle text-danger"></i> ' . __("lb.Disabled") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="moveTrushRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_trash . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> ' . __("lb.Move Trash") . '</a>';
                    return $this->dropdownAction($actions);
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
            DB::table($this->tbl)->where('id', $id)->update(['status' => 0]);
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

    public function details(Request $request){
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
