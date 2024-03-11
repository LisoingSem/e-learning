<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    use HasFactory;
    // save item to a table
    public static function saveData($tbl, $data)
    {
        try {
            if (Schema::hasColumn($tbl, 'created_by')) {
                $data['created_by'] = Auth::user()->id;
            }
            if (Schema::hasColumn($tbl, 'created_at')) {
                $data['created_at'] = Carbon::now();
            }
            $id = DB::table($tbl)->insertGetId($data);
            return (object)[
                'status' => 200,
                'data' => $id,
                'sms' =>  __('form.message.create.success'),
            ];
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' =>  __('form.message.error'),
            ]);
        }
}

    public static function updateData($tbl, $id, $data)
    {
        try {
            // check column updated_by exist
            if (Schema::hasColumn($tbl, 'updated_by')) {
                $data['updated_by'] = Auth::user()->id;
            }
            if (Schema::hasColumn($tbl, 'updated_date')) {
                $data['updated_date'] = Carbon::now();
            }

            // update data
            DB::table($tbl)
                ->where('id', $id)
                ->update($data);

            return (object)[
                'status' => 200,
                'data' => $id,
                'sms' => __('form.message.update.success'),
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' => __('form.message.error'),
            ];
        }
    }

    public static function hiddenData($tbl, $id)
    {
        try {
            if (Schema::hasColumn($tbl, 'status')) {
                DB::table($tbl)->where('id', $id)->update(['status' => 0]);
            }
            return (object)[
                'status' => 200,
                'data' => null,
                'sms' => __('form.message.disable.success'),
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' => __('form.message.error'),
            ];
        }
    }

    public static function showData($tbl, $id)
    {
        try {
            if (Schema::hasColumn($tbl, 'status')) {
                DB::table($tbl)->where('id', $id)->update(['status' => 1]);
            }
            return (object)[
                'status' => 200,
                'data' => null,
                'sms' => __('form.message.enable.success'),
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'data' => $e->getMessage(),
                'sms' => __('form.message.error'),
            ];
        }
    }
}
