<?php

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DB;

class PlaceController extends BaseApiController
{
    public function provinces(Request $request)
    {
        $provinces = DB::table('provinces')
                            ->select('provinces.id', 'provinces.name_kh', 'provinces.name_en')
                            ->where('provinces.active', 1);

        return $this->sendResponse($provinces->get(), 'Province List is successfully.');
    }

    public function districts(Request $request)
    {
        $districts = DB::table('districts')
                            ->select('districts.id', 'districts.name_kh', 'districts.name_en')
                            ->where('districts.active', 1);

        if($request->has('province_id') && $request->province_id != 0) {
            $districts = $districts->where('districts.province_id', $request->province_id);
        }

        return $this->sendResponse($districts->get(), 'District List is successfully.');
    }

    public function communes(Request $request)
    {
        $communes = DB::table('communes')
                            ->select('communes.id', 'communes.name_kh', 'communes.name_en')
                            ->where('communes.active', 1);

        if($request->has('province_id') && $request->province_id != 0) {
            $communes = $communes->where('communes.province_id', $request->province_id);
        }

        if($request->has('district_id') && $request->district_id != 0) {
            $communes = $communes->where('communes.district_id', $request->district_id);
        }

        return $this->sendResponse($communes->get(), 'Commune List is successfully.');
    }

    public function villages(Request $request)
    {
        $villages = DB::table('villages')
                            ->select('villages.id', 'villages.name_kh', 'villages.name_en')
                            ->where('villages.active', 1);

        if($request->has('province_id') && $request->province_id != 0) {
            $villages = $villages->where('villages.province_id', $request->province_id);
        }

        if($request->has('district_id') && $request->district_id != 0) {
            $villages = $villages->where('villages.district_id', $request->district_id);
        }

        if($request->has('commune_id') && $request->commune_id != 0) {
            $villages = $villages->where('villages.commune_id', $request->commune_id);
        }

        return $this->sendResponse($villages->get(), 'Village List is successfully.');
    }

    public function validCommune() {

        $communes = DB::table('communes')
                            ->select('communes.id', 'communes.code')
                            ->where('communes.active', 1)
                            ->get();

        foreach($communes as $item) {

            $code = substr($item->code, 0, -2);
            $d_code = (strlen($code) <= 3) ? "0" . $code : $code;

            $district = DB::table('districts')
                            ->where('districts.code', $d_code)
                            ->first();

            DB::table('communes')
                            ->where('communes.id', $item->id)
                            ->update([
                                'communes.district_id' => $district->id
                            ]);
                        
        }

        return $this->sendResponse(['result' => true], 'Village List is successfully.');
    }

    public function validVillage() {

        $villages = DB::table('villages')
                            ->select('villages.id', 'villages.code')
                            ->where('villages.active', 1)
                            ->get();

        foreach($villages as $item) {

            $code = substr($item->code, 0, -2);

            $commune = DB::table('communes')
                            ->where('communes.code', $code)
                            ->first();

            DB::table('villages')
                            ->where('villages.id', $item->id)
                            ->update([
                                'villages.district_id' => $commune->district_id,
                                'villages.commune_id' => $commune->id
                            ]);
                        
        }

        return $this->sendResponse(['result' => true], 'Village List is successfully.');
    }
}