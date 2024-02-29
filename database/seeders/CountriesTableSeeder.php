<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Thai',
                'name_kh' => 'ថៃ',
                'price' => 100.0,
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:24:17',
                'updated_by' => 1,
                'updated_at' => '2024-01-12 13:01:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Japan',
                'name_kh' => 'ជប៉ុន',
                'price' => 100.0,
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:26:08',
                'updated_by' => NULL,
                'updated_at' => '2024-01-12 13:02:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Singapor',
                'name_kh' => 'សិង្ហបុរី',
                'price' => 100.0,
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:26:08',
                'updated_by' => NULL,
                'updated_at' => '2024-01-12 13:02:05',
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Malaysia',
                'name_kh' => 'ម៉ាឡេស៊ី',
                'price' => 100.0,
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:26:08',
                'updated_by' => NULL,
                'updated_at' => '2024-01-12 13:02:34',
            ),
            4 => 
            array (
                'id' => 5,
                'name_en' => 'Other',
                'name_kh' => 'ផ្សេងៗ',
                'price' => 100.0,
                'active' => 1,
                'created_by' => 1,
                'created_at' => '2023-11-20 09:26:08',
                'updated_by' => NULL,
                'updated_at' => '2024-01-12 13:02:55',
            ),
        ));
        
        
    }
}