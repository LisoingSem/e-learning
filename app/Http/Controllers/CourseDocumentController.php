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
use App\Models\CourseDocument;
use Exception;
use Illuminate\Database\Query\Builder;

class CourseDocumentController extends BaseController
{
    protected $tbl = 'course_documents';

    public function index()
    {
        $data['trainners'] = Trainner::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        $data['courses'] = Course::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        return view('documents.index', $data);
    }

    public function data(Request $request)
    {
        $status = $request->input('status', 1);
        if ($status == 'trush') {
            $data = CourseDocument::onlyTrashed()
                ->leftJoin('trainners', 'course_documents.trainner_id', 'trainners.id')
                ->leftJoin('courses', 'course_documents.course_id', 'courses.id')
                ->where('course_documents.status', $status)
                ->select(
                    'course_documents.*',
                    'trainners.name as trainner_name',
                    'courses.name_en as course_name',
                )
                ->orderBy('course_documents.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_restore = route('document.restore');
                    $url_delete = route('document.delete');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="'.myEncrypt($row->id).'" href="#"><i class="mr-2 fa fa-edit text-warning"></i> '. __("lb.Edit").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="restoreRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_restore.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-recycle text-info"></i> '. __("lb.Restore").'</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="deleteRow(this)" key="'.myEncrypt($row->id).'" url="'.$url_delete.'" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> '. __("lb.Delete").'</a>';
                        return $this->dropdownAction($actions);
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($data);
        } elseif ($status == 0) {
            $data = DB::table($this->tbl)
                ->leftJoin('trainners', 'course_documents.trainner_id', 'trainners.id')
                ->leftJoin('courses', 'course_documents.course_id', 'courses.id')
                ->where('course_documents.status', $status)->whereNull('course_documents.deleted_at')
                ->select(
                    'course_documents.*',
                    'trainners.name as trainner_name',
                    'courses.name_en as course_name',
                )
                ->orderBy('course_documents.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_show = route('document.show');
                    $url_trash = route('document.trush');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="' . myEncrypt($row->id) . '" href="#"><i class="mr-2 fa fa-edit text-warning"></i> ' . __("lb.Edit") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="showRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_show . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-recycle text-info  "></i> ' . __("lb.Enable") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="moveTrushRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_trash . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> ' . __("lb.Move Trash") . '</a>';
                    return $this->dropdownAction($actions);
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($data);
        } else {
            $data = DB::table($this->tbl)
                ->leftJoin('trainners', 'course_documents.trainner_id', 'trainners.id')
                ->leftJoin('courses', 'course_documents.course_id', 'courses.id')
                ->where('course_documents.status', $status)->whereNull('course_documents.deleted_at')
                ->select(
                    'course_documents.*',
                    'trainners.name as trainner_name',
                    'courses.name_en as course_name',
                )
                ->orderBy('course_documents.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = '';
                    $url_hidden = route('document.hidden');
                    $url_trash = route('document.trush');
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="editRow(this)" key="' . myEncrypt($row->id) . '" href="#"><i class="mr-2 fa fa-edit text-warning"></i> ' . __("lb.Edit") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="hiddenRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_hidden . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-exclamation-triangle text-danger"></i> ' . __("lb.Disabled") . '</a>';
                    $actions .= '<a class="dropdown-item" style="font-size: 15px;" onclick="moveTrushRow(this)" key="' . myEncrypt($row->id) . '" url="' . $url_trash . '" _token="' . csrf_token() . '" href="#"><i class="mr-2 fa fa-trash text-danger"></i> ' . __("lb.Move Trash") . '</a>';
                    return $this->dropdownAction($actions);
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
            CourseDocument::find($id)->delete();
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
            CourseDocument::onlyTrashed()->find($id)->restore();
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
            CourseDocument::onlyTrashed()->find($id)->forceDelete();
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
