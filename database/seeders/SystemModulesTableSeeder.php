<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system_modules')->delete();
        
        \DB::table('system_modules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'system_id' => 1,
                'name' => 'Workers',
                'name_kh' => 'កម្មករ',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:29:50',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'system_id' => 1,
                'name' => 'Agencies',
                'name_kh' => 'ភ្នាក់ងារ',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:30:15',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'system_id' => 1,
                'name' => 'Invoices',
                'name_kh' => 'វិក័យបត្រ',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:30:31',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'system_id' => 1,
                'name' => 'Users',
                'name_kh' => 'អ្នកប្រើប្រាស់',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:31:01',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'system_id' => 1,
                'name' => 'Settings',
                'name_kh' => 'ការកំណត់',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:31:12',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'system_id' => 1,
                'name' => 'Worker Verification',
                'name_kh' => 'ការផ្ទៀងផ្ទាត់កម្មករ',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:41:37',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'system_id' => 1,
                'name' => 'Group',
                'name_kh' => 'ក្រុម',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:58:31',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'system_id' => 1,
                'name' => 'User Branch',
                'name_kh' => 'សាខារោងចក្រ',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 16:59:18',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'system_id' => 1,
                'name' => 'Passport Expired',
                'name_kh' => 'លិខិតឆ្លងដែនដែលផុតកំណត់',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-06 14:55:52',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'system_id' => 1,
                'name' => 'Report',
                'name_kh' => 'របាយការណ៍',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-06 15:28:19',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'system_id' => 1,
                'name' => 'Utilities Expense',
                'name_kh' => 'ការចំណាយ',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:25:11',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}