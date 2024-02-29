<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('systems')->delete();
        
        \DB::table('systems')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Labour Management System',
                'name_kh' => 'ប្រព័ន្ធគ្រប់គ្រងពលករចំណាកស្រុក',
                'short_name' => 'LMS',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2023-11-20 08:40:27',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}