<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\CourseCategory;
use Exception;
use Illuminate\Database\Query\Builder;

class CourseCategoryController extends BaseController
{
    protected $tbl = 'course_categories';

    public function index()
    {
        return view('settings.course_category.index');
    }

    public function data(Request $request)
    {
        $status = $request->input('status', 1);

        if ($status == 'trush') {
            $data = CourseCategory::onlyTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_delete = $this->btn_delete('setting.course_category.delete', $row->id);
                    $btn_restore = $this->btn_restore('setting.course_category.restore', $row->id,);
                    return $btn_restore . ' ' . $btn_delete;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->thumbnail;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="'. $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        } elseif ($status == 0) {
            $data = DB::table($this->tbl)->where('status', $status)->where('deleted_at', null)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_move_to_trush = $this->btn_move_to_trush('setting.course_category.trush', $row->id);
                    $btn_show = $this->btn_show('setting.course_category.show', $row->id,);
                    return $btn_show . ' ' . $btn_move_to_trush;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->thumbnail;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="'. $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        } else {
            $data = DB::table($this->tbl)->where('status', $status)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_hidden = $this->btn_hidden('setting.course_category.hidden', $row->id);
                    $btn_edit = $this->btn_edit('setting.course_category.update', $row->id,);
                    return $btn_edit . ' ' . $btn_hidden;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->thumbnail;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="'. $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        }
    }

    public function trash(Request $request){
        $id = myDecrypt($request->key);
        try {
            CourseCategory::find($id)->delete();
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
            CourseCategory::onlyTrashed()->find($id)->restore();
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

    public function delete(Request $request)
    {
        $id = myDecrypt($request->key);
        try {
            CourseCategory::onlyTrashed()->find($id)->forceDelete();
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
