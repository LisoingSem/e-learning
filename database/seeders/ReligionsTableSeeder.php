<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReligionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('religions')->delete();
        
        \DB::table('religions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Buddhism',
                'name_kh' => 'ព្រះពុទ្ធ',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 18:11:53',
                'updated_by' => NULL,
                'updated_at' => '2023-12-26 16:10:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Christianity',
                'name_kh' => 'គ្រិស្ត',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 18:11:53',
                'updated_by' => NULL,
                'updated_at' => '2023-12-26 16:11:23',
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Islam',
                'name_kh' => 'ឥស្លាម',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 18:11:53',
                'updated_by' => NULL,
                'updated_at' => '2023-12-26 16:10:20',
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Other',
                'name_kh' => 'ផ្សេងៗ',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 18:11:53',
                'updated_by' => NULL,
                'updated_at' => '2023-12-26 16:10:32',
            ),
        ));
        
        
    }
}