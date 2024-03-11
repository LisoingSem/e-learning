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
                ->addColumn('categories_name', function ($row) {
                    $categoryIds = json_decode($row->course_category_id);
                    $categoryNames = [];

                    if ($categoryIds == 0 || $categoryIds == null) {
                        return 'null';
                    } else {
                        foreach ($categoryIds as $categoryId) {
                            $category = DB::table('course_categories')->find($categoryId);

                            if ($category) {
                                $categoryNames = $category->name_en;
                                $buttons[] = '<span class="border mr-1 px-2 border-info rounded">' . $categoryNames . '</span>';
                            }
                        }
                        return implode($buttons);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_restore = route('course.restore');
                    $url_delete = route('course.delete');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;"  href="'.route('course.details', $row->id).'"><i class="mr-2 fa fa-info-circle text-info"></i> '. __("lb.Details").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="'.myEncrypt($row->id).'" href="#"><i class="mr-2 fa fa-edit text-warning"></i> '. __("lb.Edit").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="restoreRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_restore.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-recycle text-info"></i> '. __("lb.Restore").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="deleteRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_delete.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> '. __("lb.Delete").'</a>';
                        return $this->dropdownAction($actions);
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
                ->addColumn('categories_name', function ($row) {
                    $categoryIds = json_decode($row->course_category_id);
                    $categoryNames = [];

                    if ($categoryIds == 0 || $categoryIds == null) {
                        return 'null';
                    } else {
                        foreach ($categoryIds as $categoryId) {
                            $category = DB::table('course_categories')->find($categoryId);

                            if ($category) {
                                $categoryNames = $category->name_en;
                                $buttons[] = '<span class="border mr-1 px-2 border-info rounded">' . $categoryNames . '</span>';
                            }
                        }
                        return implode($buttons);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_show = route('course.show');
                    $url_trash = route('course.trush');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;"  href="'.route('course.details', $row->id).'"><i class="mr-2 fa fa-info-circle text-info"></i> '. __("lb.Details").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="'.myEncrypt($row->id).'" href="#"><i class="mr-2 fa fa-edit text-warning"></i> '. __("lb.Edit").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="showRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_show.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-recycle text-info  "></i> '. __("lb.Enable").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="moveTrushRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_trash.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> '. __("lb.Move Trash").'</a>';
                        return $this->dropdownAction($actions);
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
        } else {
            $data = DB::table($this->tbl)->leftJoin('trainners', 'courses.trainner_id', 'trainners.id')
                ->where('courses.status', $status)->whereNull('courses.deleted_at')
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
                                $categoryNames = $category->name_en;
                                $buttons[] = '<span class="border mr-1 px-2 border-info rounded">' . $categoryNames . '</span>';
                            }
                        }
                        return implode($buttons);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_hidden = route('course.hidden');
                    $url_trash = route('course.trush');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;"  href="'.route('course.details', $row->id).'"><i class="mr-2 fa fa-info-circle text-info"></i> '. __("lb.Details").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="'.myEncrypt($row->id).'" href="#"><i class="mr-2 fa fa-edit text-warning"></i> '. __("lb.Edit").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="hiddenRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_hidden.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-exclamation-triangle text-danger"></i> '. __("lb.Disabled").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="moveTrushRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_trash.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> '. __("lb.Move Trash").'</a>';
                        return $this->dropdownAction($actions);
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

    public function getDocumentData(Request $request, $details_id)
    {
        $data = DB::table('course_documents')
            ->where('course_documents.course_id', $details_id) ->orderBy('course_documents.created_at', 'desc')
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_edit = $this->btn_edit('document.edit', $row->id,);
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
