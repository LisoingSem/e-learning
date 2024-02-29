<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('statuses')->delete();
        
        \DB::table('statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Insufficient information',
                'name_kh' => 'ព័ត៌មានមិនគ្រប់គ្រាន',
                'color' => '#ffc725',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:40:47',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:43:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Blacklisted',
                'name_kh' => 'ជាប់ក្នុងបញ្ជីខ្មៅ',
                'color' => '#ee2228',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:40:47',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:43:13',
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Withdraw​ the passport',
                'name_kh' => 'ដកលិខិតឆ្លងដែន',
                'color' => '#ff31b8',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:40:47',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:43:13',
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Remove by Factory',
                'name_kh' => 'ក្រុមហ៊ុនគូសចេញ',
                'color' => '#9524da',
                'active' => 1,
                'created_by' => NULL,
                'created_at' => '2023-12-10 11:40:47',
                'updated_by' => NULL,
                'updated_at' => '2023-12-10 11:43:13',
            ),
        ));
        
        
    }
}