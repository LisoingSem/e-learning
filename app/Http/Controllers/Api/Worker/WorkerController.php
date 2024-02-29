<?php

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;

class WorkerController extends BaseApiController
{
    private function filter(Request $request, $user)
    {
        // SELECT 
        //     workers.id, 
        //     workers.name_en,
        //     worker_documents.`name` as photo
            
        // FROM workers
        // LEFT JOIN worker_documents on workers.id = worker_documents.worker_id
        // WHERE worker_documents.id in (SELECT max(worker_documents.id) from worker_documents GROUP BY worker_documents.worker_id)
        // -- OR worker_documents.`name` = null)
        // OR worker_documents.`name` is null

        if($user->role_id != 7) {
            $worker = DB::table('workers')
                    ->leftJoin('worker_documents', 'workers.id', 'worker_documents.worker_id')
                    ->join('worker_factories', 'workers.id', 'worker_factories.worker_id')
                    ->join('factories', 'worker_factories.factory_id', 'factories.id')
                    ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                    ->leftJoin('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                    ->select('workers.id', 'workers.id_card', 'workers.passport_no', 'workers.name_kh', 'workers.name_en', 'workers.dob', 'workers.sex', 'workers.phone_number', 
                        DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                        DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                        'progress_statuses.id as progress_status_id', 'progress_statuses.color', 'workers.is_black_list', 'worker_documents.name as photo', 
                        DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),

                    )
                    //->whereRaw("worker_documents.id in (SELECT max(worker_documents.id) FROM worker_documents GROUP BY worker_documents.worker_id)")

                    ->where(function($query) {
                        $query->whereRaw("worker_documents.id in (SELECT max(worker_documents.id) FROM worker_documents GROUP BY worker_documents.worker_id)");
                        $query->orWhereRaw("worker_documents.name is null");
                    })

                    ->where('workers.active', 1)
                    ->orderBy('workers.created_at', 'desc');

        } else {
            $worker = DB::table('workers')
                    ->join('worker_factories', 'workers.id', 'worker_factories.worker_id')
                    ->join('factories', 'worker_factories.factory_id', 'factories.id')
                    ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                    ->leftJoin('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                    ->select('workers.id', 'workers.id_card', DB::raw('"" as passport_no'), 'workers.name_kh', 'workers.name_en', 
                        'workers.dob', 'workers.sex', DB::raw('"" as phone_number'), 
                        DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                        DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                        'progress_statuses.id as progress_status_id', 'progress_statuses.color', 'workers.is_black_list', 'workers.photo', 
                        DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),
                    )
                    ->where('workers.active', 1)
                    ->orderBy('workers.created_at', 'desc');
        }

        // search
        if($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $worker = $worker->where(function($query) use ($search) {

                $query->where('workers.name_kh', 'LIKE', "%{$search}%");
                $query->orWhere('workers.id_card', 'LIKE', "%{$search}%");
                $query->orWhere('workers.passport_no', 'LIKE', "%{$search}%");
                $query->orWhere('workers.name_en', 'LIKE', "%{$search}%");
                $query->orWhere('workers.phone_number', 'LIKE', "%{$search}%");
            });
        }

        // agency
        if($request->has('agency_id') && $request->agency_id != 0) {
            $worker = $worker->where('worker_factories.agency_id', $request->agency_id);
        }

        // country
        if($request->has('country_id') && $request->country_id != 0) {
            $worker = $worker->where('factories.country_id', $request->country_id);
        }

        // factory
        if($request->has('factory_id') && $request->factory_id != 0) {
            $worker = $worker->where('worker_factories.factory_id', $request->factory_id);
        }

        // branch
        if($request->has('branch_id') && $request->branch_id != 0) {
            $worker = $worker->where('worker_factories.factory_branch_id', $request->branch_id);
        }

        // status
        if($request->has('status') && $request->status != 0) {
            $worker = $worker->where('workers.is_black_list', $request->status);
        }

        // process status
        if($request->has('process_status') && $request->process_status != 0) {
            $worker = $worker->where('workers.progress_status_id', $request->process_status);
        }

        return $worker;
    }

    public function checking(Request $request)
    {
        if($request->id_number == '012900600' && $request->dob == '1990-01-15') {

            return $this->sendResponse([
                "id" => "1",
                "id_card" => "012900600",
                "passport_no" => null,
                "name_kh" => null,
                "name_en" => null,
                "dob" => "1990-01-15",
                "sex" => "2",
                "phone_number" => null,
                "pob_provinces" => null,
                "pob_address" => null,
                "color" => "#fbbc06",
                "is_black_list" => "0",
                "photo" => null,
                "status" => "កំពុងរៀបឯកសារ (Pending)",
                "address_kh" => null,
                "address_en" => null,
                "register_date" => "2024-01-23 16:14:27"
            ], 'Check Worker is successfully.');

        } else {
            $worker = DB::table('workers')
                        ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                        ->join('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                        ->leftJoin('villages', 'workers.village_id', 'villages.id')
                        ->leftJoin('communes', 'workers.commune_id', 'communes.id')
                        ->leftJoin('districts', 'workers.district_id', 'districts.id')
                        ->leftJoin('provinces', 'workers.province_id', 'provinces.id')
                        ->leftJoin('worker_documents', 'workers.id', 'worker_documents.worker_id')
                        ->select('workers.id', 'workers.id_card', 'workers.passport_no', 'workers.name_kh', 'workers.name_en', 'workers.dob', 'workers.sex', 'workers.phone_number', 
                            DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                            DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                            'progress_statuses.id', 'progress_statuses.color', 'workers.is_black_list', 'worker_documents.name as photo', 
                            DB::raw("CASE
                                        WHEN progress_statuses.id = 1 THEN CONCAT('កំពុងរៀបឯកសារ', ' (', progress_statuses.name_en, ')')
                                        ELSE CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')')
                                    END as status"),
                            DB::raw("CONCAT(villages.name_kh, ' ', communes.name_kh, ' ', districts.name_kh, ' ', provinces.name_kh) as address_kh"),
                            DB::raw("CONCAT(villages.name_en, ', ', communes.name_en, ', ', districts.name_en, ', ', provinces.name_en) as address_en"),
                            "workers.created_at as register_date"
                        )
                        ->where('workers.id_card', $request->id_number)
                        ->where('workers.dob', $request->dob)
                        ->where('workers.active', 1)
                        ->where(function($query) {
                            $query->whereRaw("worker_documents.id in (SELECT max(worker_documents.id) FROM worker_documents GROUP BY worker_documents.worker_id)");
                            $query->orWhereRaw("worker_documents.name is null");
                        })
                        ->first();

            if($worker != null) {
                return $this->sendResponse($worker, 'Check Worker is successfully.');
            } else {
                return $this->sendError('There is no worker profile', ['error'=>'Not Found']);
            }
        }
    }

    public function filterList(Request $request)
    {
        return $this->sendResponse([
            'agencies' => DB::table('agencies')
                            ->select('agencies.id', 'agencies.name_kh', 'agencies.name_en')
                            ->where('agencies.active', 1)
                            ->get(),
            'countries' => DB::table('countries')
                            ->select('countries.id', 'countries.name_kh', 'countries.name_en')
                            ->where('countries.active', 1)
                            ->get()

        ], 'Filter Worker List is successfully.');
    }

    public function factories(Request $request)
    {
        $factories = DB::table('factories')
                            ->select('factories.id', 'factories.name_kh', 'factories.name_en')
                            ->where('factories.active', 1);

        if($request->has('country_id')) {
            $factories = $factories->where('factories.country_id', $request->country_id);
        }

        return $this->sendResponse($factories->get(), 'Factories List is successfully.');
    }

    public function branches(Request $request)
    {
        $branches = DB::table('factory_branches')
                            ->select('factory_branches.id', 'factory_branches.name_kh', 'factory_branches.name_en')
                            ->where('factory_branches.active', 1);

        if($request->has('factory_id')) {
            $branches = $branches->where('factory_branches.factory_id', $request->factory_id);
        }

        return $this->sendResponse($branches->get(), 'Branches Worker List is successfully.');
    }

    public function search(Request $request)
    {
        $user = Auth::user(); 
        $worker = $this->filter($request, $user);
        
        if($user->role_id != 7) {
            $perPage = 20;
            $page = $request->input('page', 1);
            $count = $worker->count();
            $result = $worker->offset(($page - 1) * $perPage)->limit($perPage)->get();
            $total_page = intdiv($count, $perPage);
            if(($count % $perPage) > 0) {
                $total_page += 1;
            }

            return $this->sendResponse([
                'data' => $result,
                'count' => $count,
                'page' => $page,
                'per_page' => $perPage,
                'total_page' => $total_page

            ], ' Search Worker List is successfully.');
        } else {

            $count = 3;
            return $this->sendResponse([
                'data' => $worker->limit($count)->get(),
                'count' => $count,
                'page' => 1,
                'per_page' => 20,
                'total_page' => 1

            ], ' Worker List is successfully.');
        }
    }

    public function get(Request $request)
    {
        $user = Auth::user(); 
        $worker = $this->filter($request, $user);
        
        if($user->role_id != 7) {
            $perPage = 20;
            $page = $request->input('page', 1);
            $count = $worker->count();
            $result = $worker->offset(($page - 1) * $perPage)->limit($perPage)->get();
            $total_page = intdiv($count, $perPage);
            if(($count % $perPage) > 0) {
                $total_page += 1;
            }

            return $this->sendResponse([
                'data' => $result,
                'count' => $count,
                'page' => $page,
                'per_page' => $perPage,
                'total_page' => $total_page

            ], ' Worker List is successfully.');
        } else {

            $count = 3;
            return $this->sendResponse([
                'data' => $worker->limit($count)->get(),
                'count' => $count,
                'page' => 1,
                'per_page' => 20,
                'total_page' => 1

            ], ' Worker List is successfully.');
        }
    }

    public function detail(Request $request)
    {
        $user = Auth::user(); 

        

        if($user->role_id != 7) {
            $worker = DB::table('workers')
                    ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                    ->join('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                    ->leftJoin('villages', 'workers.village_id', 'villages.id')
                    ->leftJoin('communes', 'workers.commune_id', 'communes.id')
                    ->leftJoin('districts', 'workers.district_id', 'districts.id')
                    ->leftJoin('provinces', 'workers.province_id', 'provinces.id')
                    ->select('workers.id', 'workers.id_card', 'workers.passport_no', 'workers.name_kh', 'workers.name_en', 'workers.dob', 'workers.sex', 'workers.phone_number', 
                        DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                        DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                        'progress_statuses.id as progress_statuses_id', 'progress_statuses.color', 'workers.is_black_list', 
                        DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),
                        "workers.province_id", "workers.district_id", "workers.commune_id", "workers.village_id",
                        DB::raw("CONCAT(villages.name_kh, ' ', communes.name_kh, ' ', districts.name_kh, ' ', provinces.name_kh) as address_kh"),
                        DB::raw("CONCAT(villages.name_en, ', ', communes.name_en, ', ', districts.name_en, ', ', provinces.name_en) as address_en"),
                        DB::raw("'' as photo"),
                    )
                    ->where('workers.id', $request->id)
                    ->where('workers.active', 1)
                    ->first();

            if($worker != null) {

                $worker->photo = DB::table('worker_documents')
                        ->select('worker_documents.id as worker_doc_id', 'worker_documents.name', 'worker_documents.type', 'worker_documents.path'
                        )
                        ->where('worker_documents.worker_id', $request->id)
                        ->where('worker_documents.active', 1)
                        ->where(function($query) {
                            $query->where('worker_documents.type', 'image');
                            $query->orWhere('worker_documents.type', 'video');
                        })
                        ->get();

                return $this->sendResponse($worker, 'Check Worker is successfully.');
            } else {
                return $this->sendError('There is no worker profile', ['error'=>'Not Found']);
            }
        } else {

            $worker = DB::table('workers')
                    ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                    ->join('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                    ->leftJoin('villages', 'workers.village_id', 'villages.id')
                    ->leftJoin('communes', 'workers.commune_id', 'communes.id')
                    ->leftJoin('districts', 'workers.district_id', 'districts.id')
                    ->leftJoin('provinces', 'workers.province_id', 'provinces.id')
                    ->select('workers.id', DB::raw("'' as id_card"), DB::raw("'' as passport_no"), 'workers.name_kh', 'workers.name_en', 'workers.dob', 'workers.sex', DB::raw("'' as phone_number"), 
                        DB::raw("'' as pob_provinces"),
                        DB::raw("'' as pob_address"),
                        'progress_statuses.id as progress_statuses_id', 'progress_statuses.color', 'workers.is_black_list', 
                        DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),
                        "workers.province_id", "workers.district_id", "workers.commune_id", "workers.village_id",
                        DB::raw("'' as address_kh"),
                        DB::raw("'' as address_en"),
                        DB::raw("'' as photo"),
                    )
                    ->where('workers.id', $request->id)
                    ->where('workers.active', 1)
                    ->first();

            return $this->sendResponse($worker, 'Check Worker is successfully.');

        }

        
    }

    public function update(Request $request)
    {
        $updateData = [
            'workers.name_kh' =>  $request->name_kh,
            'workers.name_en' =>  $request->name_en,
            'workers.id_card' =>  $request->id_card,
            'workers.dob' =>  $request->dob,
            'workers.passport_no' =>  $request->passport_no,
            'workers.phone_number' =>  $request->phone_number,
            'workers.province_id' =>  $request->province_id,
            'workers.district_id' =>  $request->district_id,
            'workers.commune_id' =>  $request->commune_id,
            'workers.village_id' =>  $request->village_id,
        ];

        $result = DB::table('workers')
                    ->where('workers.id', $request->id)
                    ->update($updateData);

        $userData = DB::table('workers')
                ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                ->join('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                ->select('workers.id', 'workers.id_card', 'workers.passport_no', 'workers.name_kh', 'workers.name_en', 'workers.dob', 'workers.sex', 'workers.phone_number', 
                    DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                    DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                    'workers.province_id',
                    'progress_statuses.id', 'progress_statuses.color', 'workers.is_black_list', 
                    DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),
                    DB::raw("'' as photo"),
                )
                ->where('workers.id', $request->id)
                ->first();

        return $this->sendResponse($userData, 'User has been change password successfully.');
    }

    public function workerDocument(Request $request)
    {
        $user = auth()->user();
        $worker = DB::table('workers')
                            ->select('workers.id', 'workers.name_kh', 'workers.name_en')
                            ->where('workers.active', 1)
                            ->where('workers.id', $request->worker_id)
                            ->first();

        if($worker == null) {
            return $this->sendError('This worker information is not found.', ['error'=>'Not Found']);
        }

        $worker_doc_id = 0;

        if($request->has('worker_doc_id') && $request->worker_doc_id != 0) {

            $worker_doc_id = $request->worker_doc_id;
            DB::table('worker_documents')
                    ->where('worker_documents.id', $request->worker_doc_id)
                    ->where('worker_documents.active', 1)
                    ->update([
                        
                        "path" => $request->path,
                        "updated_by" => $user->id,
                        "updated_at" => now(),
                    ]);
                    
        } else {
            $worker_doc_id = DB::table('worker_documents')->insertGetId(
                [
                    "worker_id" => $request->worker_id,
                    "name" => "youtube",
                    "type" => "video",
                    "path" => $request->path,
                    "active" => 1,
                    "created_by" => $user->id,
                    "created_at" => now(),
                    "updated_by" => $user->id,
                    "updated_at" => now(),

                ]
            );
        }

        return $this->sendResponse([
            'worker_id' => $request->worker_id,
            'worker_doc_id' => $worker_doc_id,
            'path' => $request->path,
            'test' => asset('storage/app/public/image/')

        ], 'Worker has been set black list successfully.');
    }

    public function blackList(Request $request)
    {
        $user = auth()->user();

        $validList = [
            'worker_id' => 'required',
            'reason' => 'required',
            'status' => 'required',
        ];

        if($request->status != 0) {

            $validList['type'] = 'required';
            $validList['start_date'] = 'required';
            $validList['duration'] = 'required';

            if($request->type == 1) {
                $validList['country_id'] = 'required';
            } else {
                $validList['factory_id'] = 'required';
            }

        }

        // $this->validate($request, $validList);
        $validator = Validator::make($request->all(), $validList);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $result = DB::table('workers')
                    ->where('workers.id', $request->worker_id)
                    ->where('workers.active', 1)
                    ->update([
                        'workers.is_black_list' => $request->status
                    ]);

        $data = [
            "worker_id" => $request->worker_id,
            "blacklist_date" => now(),
            "reason" => $request->reason,
            "active" => 1,
            "created_by" => $user->id,
            "created_at" => now(),
            "updated_by" => $user->id,
            "updated_at" => now(),
        ];

        if($request->status != 0) { // black list

            $currentDateTime = Carbon::parse($request->start_date);

            $data['type'] = $request->type;
            $data['reason'] = $request->reason;
            $data['start_date'] = $request->start_date;
            $data['duration'] = $request->duration;
            $data['end_date'] = $currentDateTime->addMonths($request->duration);

            if($request->type == 1) {
                $data['country_id'] = $request->country_id;
            } else {
                $data['factory_id'] = $request->factory_id;
            }
        }

        DB::table('worker_blacklist_histories')->insert($data);

        // if($result <= 0) {
        //     return $this->sendError('Exist username and password is not valid', ['error'=>'Not Found']);
        // }

        $worker = DB::table('workers')
                    ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                    ->join('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                    ->select('workers.id', 'workers.id_card', 'workers.passport_no', 'workers.name_kh', 'workers.name_en', 
                        'workers.dob', 'workers.sex', 'workers.phone_number', 'workers.is_black_list', 'workers.photo', 
                        DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                        DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                        DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),
                    )
                    ->where('workers.id', $request->worker_id)
                    ->where('workers.active', 1)
                    ->first();

        return $this->sendResponse($worker, 'Worker has been set black list successfully.');
    }

    public function takeOut(Request $request) {

        $user = auth()->user();
        // save worker status to table worker_statuses for history  worker_statuses
        $remove_status = 4;
        $id = DB::table("worker_statuses")->insertGetId([
            'worker_id' => $request->worker_id, 
            'status_id' => $remove_status, 
            'reason' => $request->remove_reason,
            'active' => 1, 
            'created_by' => $user->id,
            'created_at' => now(),
            'updated_by' => $user->id,
            'updated_at' => now()
        ]);

        // when success save worker status
        // update worker status to remove by factory
        DB::table('workers')->where('id', $request->worker_id)->update([
            'status_id'=> $remove_status,  
            'is_removed_by_company' => 1
        ]);
        
        // update current worker factory to remove by factory also.
        DB::table('worker_factories')
                    ->where('worker_id', $request->worker_id)
                    ->where('is_current', 1)
                    ->update([
                        'is_factory_removed' => 1, 
                        'factory_removed_date' => date('Y-m-d'),
                        'factory_removed_reason' => $request->remove_reason
                    ]);


        $worker = DB::table('workers')
                    ->join('progress_statuses', 'workers.progress_status_id', 'progress_statuses.id')
                    ->join('pob_provinces', 'workers.pob_province_id', 'pob_provinces.id')
                    ->select('workers.id', 'workers.id_card', 'workers.passport_no', 'workers.name_kh', 'workers.name_en', 
                        'workers.dob', 'workers.sex', 'workers.phone_number', 'workers.is_black_list', 'workers.photo', 
                        DB::raw("CONCAT(pob_provinces.name_kh, ' (', pob_provinces.name_en, ')') as pob_provinces"),
                        DB::raw("CONCAT(workers.pob_village, ' ', workers.pob_commune, ' ', workers.pob_district) as pob_address"),
                        DB::raw("CONCAT(progress_statuses.name_kh, ' (', progress_statuses.name_en, ')') as status"),
                    )
                    ->where('workers.id', $request->worker_id)
                    ->where('workers.active', 1)
                    ->first();
        
        
        return $this->sendResponse($worker, 'Worker has been set black list successfully.');

    }
}