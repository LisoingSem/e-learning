<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\CourseVideo;
use App\Models\Trainner;
use App\Models\CourseCategory;
use App\Models\Course;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;

class CourseVideoController extends BaseController
{
    protected $tbl = 'course_videos';

    public function index()
    {
        $data['trainners'] = Trainner::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        $data['courses'] = Course::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        return view('videos.index', $data);
    }

    public function data(Request $request)
    {
        $status = $request->input('status', 1);
        if ($status == 'trush') {
            $data = CourseVideo::onlyTrashed()
            ->leftJoin('trainners', 'course_videos.trainner_id', 'trainners.id')
            ->leftJoin('courses', 'course_videos.course_id', 'courses.id')
            ->where('course_videos.status', $status)
            ->select(
                'course_videos.*',
                'trainners.name as trainner_name',
                'courses.name_en as course_name',
            )
            ->orderBy('course_videos.created_at', 'desc')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_delete = $this->btn_delete('video.delete', $row->id);
                    $btn_restore = $this->btn_restore('video.restore', $row->id,);
                    return $btn_restore . ' ' . $btn_delete;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($data);
        } elseif ($status == 0) {
            $data = DB::table($this->tbl)
                ->leftJoin('trainners', 'course_videos.trainner_id', 'trainners.id')
                ->leftJoin('courses', 'course_videos.course_id', 'courses.id')
                ->where('course_videos.status', $status)->whereNull('course_videos.deleted_at')
                ->select(
                    'course_videos.*',
                    'trainners.name as trainner_name',
                    'courses.name_en as course_name',
                )
                ->orderBy('course_videos.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_move_to_trush = $this->btn_move_to_trush('video.trush', $row->id);
                    $btn_show = $this->btn_show('video.show', $row->id,);
                    return $btn_show . ' ' . $btn_move_to_trush;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($data);
        } else {
            $data = DB::table($this->tbl)
                ->leftJoin('trainners', 'course_videos.trainner_id', 'trainners.id')
                ->leftJoin('courses', 'course_videos.course_id', 'courses.id')
                ->where('course_videos.status', $status)
                ->select(
                    'course_videos.*',
                    'trainners.name as trainner_name',
                    'courses.name_en as course_name',
                )
                ->orderBy('course_videos.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_hidden = $this->btn_hidden('video.hidden', $row->id);
                    $btn_edit = $this->btn_edit('video.edit', $row->id,);
                    return  $btn_edit . ' ' . $btn_hidden;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($data);
        }
    }

    public function trush(Request $request)
    {
        $id = myDecrypt($request->key);
        try {
            CourseVideo::find($id)->delete();
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
            CourseVideo::onlyTrashed()->find($id)->restore();
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
            CourseVideo::onlyTrashed()->find($id)->forceDelete();
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
