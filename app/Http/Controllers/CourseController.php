<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\BaseModel;
use App\Models\Settings\System;
use App\Models\Course;
use App\Models\Trainner;
use App\Models\CourseCategory;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends BaseController
{
    protected $tbl = 'courses';

    public function index()
    {
        $data['course_categories'] = CourseCategory::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        $data['trainners'] = Trainner::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        return view('courses.index', $data);
    }

    public function data(Request $request)
    {
        $status = $request->input('status', 1);
        if ($status == 'trush') {
            $data = Course::onlyTrashed()
                ->leftJoin('trainners', 'courses.trainner_id', 'trainners.id')
                ->leftJoin('course_categories', 'courses.course_category_id', 'course_categories.id')
                ->select(
                    'courses.*',
                    'trainners.name as trainner_name',
                    'course_categories.name_en as category_name',
                )
                ->orderBy('courses.updated_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_delete = $this->btn_delete('course.delete', $row->id);
                    $btn_restore = $this->btn_restore('course.restore', $row->id,);
                    return $btn_restore . ' ' . $btn_delete;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->thumbnail;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="' . $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        } elseif ($status == 0) {
            $data = DB::table($this->tbl)->leftJoin('trainners', 'courses.trainner_id', 'trainners.id')
                ->leftJoin('course_categories', 'courses.course_category_id', 'course_categories.id')
                ->where('courses.status', $status)->whereNull('courses.deleted_at')
                ->select(
                    'courses.*',
                    'trainners.name as trainner_name',
                    'course_categories.name_en as category_name',
                )->orderBy('courses.updated_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_move_to_trush = $this->btn_move_to_trush('course.trush', $row->id);
                    $btn_show = $this->btn_show('course.show', $row->id,);
                    return $btn_show . ' ' . $btn_move_to_trush;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->thumbnail;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="' . $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
            return response()->json($data);
        } else {
            $data = DB::table($this->tbl)->leftJoin('trainners', 'courses.trainner_id', 'trainners.id')
                ->where('courses.status', $status)
                ->select(
                    'courses.*',
                    'trainners.name as trainner_name',
                )->orderBy('courses.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('categories_name', function ($row) {
                    $categoryIds = json_decode($row->course_category_id);
                    $categoryNames = [];

                    if ($categoryIds == 0 || $categoryIds == null) {
                        return 'null';
                    } else {
                        foreach ($categoryIds as $categoryId) {
                            $category = DB::table('course_categories')->find($categoryId);

                            if ($category) {
                                $categoryNames[] = $category->name_en;
                            }
                        }

                        return implode(', ', $categoryNames);
                    }

                })
                ->addColumn('action', function ($row) {
                    $btn_hidden = $this->btn_hidden('course.hidden', $row->id);
                    $btn_edit = $this->btn_edit('course.edit', $row->id,);
                    $btn_details = '<a href="' . route("course.details", $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i></a>';
                    return  $btn_details . ' ' .  $btn_edit . ' ' . $btn_hidden;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = $row->thumbnail;
                    $fallbackImage = asset('img/error-img.png');

                    return empty($thumbnail)
                        ? '<img src="' . $fallbackImage . '" class="rounded-circle" width="30px" height="30px">'
                        : '<img src="' . $thumbnail . '" class="rounded-circle object-fit-cover" width="30px" height="30px">';
                })
                ->rawColumns(['action', 'thumbnail', 'categories_name'])
                ->make(true);
            return response()->json($data);
        }
    }

    public function details(Request $request, $details_id = '')
    {
        $data['trainners'] = Trainner::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        $data['courses'] = Course::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        $data['details'] = DB::table($this->tbl)->leftJoin('trainners', 'courses.trainner_id', 'trainners.id')
            ->leftJoin('course_categories', 'course_categories.id', 'courses.course_category_id')
            ->where('courses.id', $details_id)
            ->select(
                'courses.*',
                'trainners.name as trainner_name',
                'course_categories.name_en as category_name',
            )->orderBy('courses.created_at', 'desc')
            ->first();
        //return $data;
        return view('course_details.index', $data);
    }

    public function getVideoData(Request $request, $details_id)
    {
        $data = DB::table('course_videos')
            ->where('course_videos.course_id', $details_id)->orderBy('course_videos.created_at', 'desc')
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_edit = $this->btn_edit('video.edit', $row->id,);
                return  $btn_edit;
            })
            ->rawColumns(['action', 'thumbnail'])
            ->make(true);
        return response()->json($data);
    }

    public function save(Request $request)
    {
        $data = $request->except('_token', 'course_category_id');
        $data['course_category_id'] = json_encode($request->course_category_id);
        $res = BaseModel::saveData($this->tbl, $data);
        return $res;
    }

    public function update(Request $request)
    {
        $id = myDecrypt($request->id);
        $data = $request->except('_token', 'course_category_id', 'id');
        $data['course_category_id'] = json_encode($request->course_category_id);
        $res = BaseModel::updateData($this->tbl, $id, $data);
        return $res;
    }

    public function trush(Request $request)
    {
        $id = myDecrypt($request->key);
        try {
            Course::find($id)->delete();
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
            Course::onlyTrashed()->find($id)->restore();
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
            Course::onlyTrashed()->find($id)->forceDelete();
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
