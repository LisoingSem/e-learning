<?php

namespace App\Imports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\BaseModel;
use Hash;
use DB;

class WorkersImport implements ToModel, WithHeadingRow
{
    protected $country_id;
    protected $factory_id;
    protected $factory_branch_id;
    public function  __construct()
    {
        // $this->province_id= $province_id;
        // $this->factory_id= $factory_id;
        // $this->factory_branch_id= $factory_branch_id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model($row)
    {
        $worker = (object) $row;
        // dd($worker);
        // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($worker->dob))->format('Y-m-d');
        // echo $date;
        // exit();
        // echo reverse_date($worker->dob);
        // exit();
        $data = [
            'progress_status_id' => 1,
            'code' => strtotime(now()),
            'name_kh' => $worker->name_kh,
            'name_en' => $worker->name_en,
            'sex' => ($worker->sex="M")?1:2,
            'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($worker->dob))->format('Y-m-d'),
            'id_card' => $worker->id_card,
            'height' => $worker->height,
            'weight' => $worker->weight,
            'thailand_verification_no' => $worker->thailand_verification_no,
            'passport_no' => $worker->passport_no,
            'passport_issued' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($worker->passport_issued))->format('Y-m-d'),
            'passport_expired' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($worker->passport_expired))->format('Y-m-d'),
            'travel_letter_no' => $worker->travel_letter_no,
            'phone_number' => $worker->phone_number,
            'email' => $worker->email,
            'is_driver_licence' => ( $worker->driver_licence_no != '') ? 1 : 0,
            'driver_licence_no' => $worker->driver_licence_no,
            'degree_id' => 1,
            'created_by' => auth()->user()->id
            // 'emergency_contact' => $worker->emergency_contact,
            // 'emergency_name' => $worker->emergency_name,
            // 'emergency_relationship' => $worker->emergency_relationship,
            // 'emergency_address' => $worker->emergency_address,
            // 'profesional_skill_name' => $worker->profesional_skill_name,
            // 'profesional_skill_level' => $worker->profesional_skill_level,
            // 'faculty_skill_name' => $worker->faculty_skill_name,
            // 'faculty_skill_level' => $worker->faculty_skill_level,
           
        ];
        $id = Worker::insertGetId($data);
        $dataParrent = [
            'worker_id' => $id,
            'father_name' => '',
            'father_age' => 0,
            'mother_name' => '',
            'mother_age' => 0,
            'street_no' => '',
            'home_no' => '',
            'group_no' => '',
            'province_id' => 0,
            'district_id' => 0,
            'commune_id' => 0,
            'village_id' => 0,
            'phone_number' => '',
        ];
        BaseModel::saveData('worker_parents', $dataParrent);

        $dataSpouse = [
            'worker_id' => $id,
            'name' => '',
            'street_no' => '',
            'home_no' => '',
            'group_no' => '',
            'province_id' => 0,
            'district_id' => 0,
            'commune_id' => 0,
            'village_id' => 0,
            'phone_number' =>'',
        ];
        BaseModel::saveData('worker_couples', $dataSpouse);

        $dataWorkerFactory = [
            'worker_id' => $id,
            'country_id' => 0,
            'factory_id' => 0,
            'factory_branch_id' => 0,
            'agency_id' => 0,
            'is_the_same_address' => 0,
            'address' => '',
            'start_date' => null,
            'end_date' => null,
            'contract_length' => 0,
            'is_countinue' => 0,
        ];
        BaseModel::saveData('worker_factories', $dataWorkerFactory);

        $dataWorkerLang = [
            'worker_id' => $id,
            'language_id' => 1
        ];
        BaseModel::saveData('worker_languages', $dataWorkerLang);

        BaseModel::saveData('worker_interviews', ['worker_id' => $id, 'factory_id'=> 0, 'factory_branch_id' => 0]);
        BaseModel::saveData('worker_progress_histories', [
            'worker_id' => $id, 
            'factory_id' => 0, 
            'progress_status_id' => 1, 
            'progress_date' => date('Y-m-d'), 
            'progress_note' => "Import"
        ]);

    }

    private function reverse_date($date_string){
        // $date = ;
        // return $date;
        // if (strpos($date_string, '-') !== false){
        //     $a_date = explode('-', $date_string);
        // }elseif(strpos($date_string, '.') !== false){
        //     $a_date = explode('.', $date_string);
        // }
        // elseif(strpos($date_string, '/') !== false){
        //     $a_date = explode('/', $date_string);
        // }
        
        // if(sizeof($a_date) == 3){
        //     return $a_date[2] . '-' . $a_date[1] . '-' . $a_date[0];
        // }else{
        //     return "0000-00-00";
        // }
    }
}
