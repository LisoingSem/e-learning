<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemFeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system_features')->delete();
        
        \DB::table('system_features')->insert(array (
            0 => 
            array (
                'id' => 1,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:31:29',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'Create',
                'name_kh' => 'បង្កើត',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:31:44',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:31:50',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'Delete',
                'name_kh' => 'លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:31:59',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'Change Notation Status',
                'name_kh' => 'កត់ត្រាស្ថានភាព',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:33:05',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'Change Progress Status',
                'name_kh' => 'ប្ដូរស្ថានភាពដំណើរការ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:33:29',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'system_id' => 1,
                'module_id' => 6,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:41:46',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'system_id' => 1,
                'module_id' => 6,
                'name' => 'Verify',
                'name_kh' => 'ផ្ទៀងផ្ទាត់',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:42:00',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'system_id' => 1,
                'module_id' => 2,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:42:47',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'system_id' => 1,
                'module_id' => 2,
                'name' => 'Create',
                'name_kh' => 'បង្កើត',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:42:54',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'system_id' => 1,
                'module_id' => 2,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:43:06',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'system_id' => 1,
                'module_id' => 2,
                'name' => 'Delete',
                'name_kh' => 'លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:43:22',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'system_id' => 1,
                'module_id' => 3,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:44:31',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'system_id' => 1,
                'module_id' => 3,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:44:46',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'system_id' => 1,
                'module_id' => 3,
                'name' => 'Make Payment',
                'name_kh' => 'បង់ប្រាក់',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:45:06',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'system_id' => 1,
                'module_id' => 4,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:48:16',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'system_id' => 1,
                'module_id' => 4,
                'name' => 'Create',
                'name_kh' => 'បង្កើត',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:48:23',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'system_id' => 1,
                'module_id' => 4,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:48:32',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'system_id' => 1,
                'module_id' => 4,
                'name' => 'Delete',
                'name_kh' => 'លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:48:38',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'system_id' => 1,
                'module_id' => 5,
                'name' => 'View, Create, Edit, Delete',
                'name_kh' => 'មើល បង្កើត កែប្រែ លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:51:57',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'system_id' => 1,
                'module_id' => 7,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:58:38',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'system_id' => 1,
                'module_id' => 7,
                'name' => 'Create',
                'name_kh' => 'បង្កើត',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:58:47',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'system_id' => 1,
                'module_id' => 7,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:58:58',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'system_id' => 1,
                'module_id' => 7,
                'name' => 'Delete',
                'name_kh' => 'លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:59:04',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'system_id' => 1,
                'module_id' => 8,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 16:59:58',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'system_id' => 1,
                'module_id' => 8,
                'name' => 'Creare',
                'name_kh' => 'បង្កើត',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 17:00:21',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'system_id' => 1,
                'module_id' => 8,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 17:00:26',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'system_id' => 1,
                'module_id' => 8,
                'name' => 'Delete',
                'name_kh' => 'លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 17:00:33',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'system_id' => 1,
                'module_id' => 9,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-06 14:56:45',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'system_id' => 1,
                'module_id' => 10,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-06 15:35:12',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'system_id' => 1,
                'module_id' => 11,
                'name' => 'View',
                'name_kh' => 'មើល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:25:22',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'system_id' => 1,
                'module_id' => 11,
                'name' => 'Create',
                'name_kh' => 'បង្កើត',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:25:32',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'system_id' => 1,
                'module_id' => 11,
                'name' => 'Edit',
                'name_kh' => 'កែប្រែ',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:25:39',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'system_id' => 1,
                'module_id' => 11,
                'name' => 'Delete',
                'name_kh' => 'លុប',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:25:43',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'system_id' => 1,
                'module_id' => 1,
                'name' => 'Import',
                'name_kh' => 'នាំចូល',
                'links' => '',
                'description' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-13 20:45:23',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}