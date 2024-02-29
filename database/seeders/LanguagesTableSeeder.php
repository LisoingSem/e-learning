<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'English',
                'name_kh' => 'អង់គ្លេស',
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:35:59',
                'updated_by' => NULL,
                'updated_at' => '2024-01-12 12:54:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Malay',
                'name_kh' => 'ម៉ាឡេ',
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:36:14',
                'updated_by' => NULL,
                'updated_at' => '2024-01-12 12:54:36',
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Chinese',
                'name_kh' => 'ចិន',
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:36:14',
                'updated_by' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Thai',
                'name_kh' => 'ថៃ',
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:36:14',
                'updated_by' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name_en' => 'Japan',
                'name_kh' => 'ជប៉ុន',
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:36:14',
                'updated_by' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name_en' => 'Other',
                'name_kh' => 'ផ្សេងៗ',
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:36:14',
                'updated_by' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}