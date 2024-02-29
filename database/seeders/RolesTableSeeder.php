<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Supper Admin',
                'name_kh' => 'Supper Admin',
                'permission' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2023-11-20 08:18:13',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Manager',
                'name_kh' => 'អ្នកគ្រប់គ្រង',
                'permission' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2023-11-20 08:18:28',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Normal User',
                'name_kh' => 'អ្នកប្រើប្រាស់ធម្មតា',
                'permission' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2023-11-20 08:26:50',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}