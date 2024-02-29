<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProgressStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('progress_statuses')->delete();
        
        \DB::table('progress_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Pending',
                'name_kh' => 'នៅសល់',
                'color' => '#fa1939',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:35:30',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:36:12',
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Prepare document',
                'name_kh' => 'រៀបចំឯកសារ',
                'color' => '#891915',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:35:30',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:36:12',
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Get Ready',
                'name_kh' => 'ត្រៀមខ្លួន',
                'color' => '#21408f',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:35:30',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:36:12',
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Delay',
                'name_kh' => 'មិនទាន់ទៅ',
                'color' => '#f9721f',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:35:30',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:36:12',
            ),
            4 => 
            array (
                'id' => 5,
                'name_en' => 'Reach the Destination',
                'name_kh' => 'ទៅដល់គោលដៅ',
                'color' => '#0ab759',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:35:30',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:36:12',
            ),
        ));
        
        
    }
}