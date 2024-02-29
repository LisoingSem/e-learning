<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FeatureLinksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('feature_links')->delete();
        
        \DB::table('feature_links')->insert(array (
            0 => 
            array (
                'id' => 1,
                'feature_id' => 1,
                'name' => 'worker.all',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:10',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'feature_id' => 1,
                'name' => 'worker.pending',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:19',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'feature_id' => 1,
                'name' => 'worker.prepare_document',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:26',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'feature_id' => 1,
                'name' => 'worker.get_ready',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:34',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'feature_id' => 1,
                'name' => 'worker.delay',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:40',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'feature_id' => 1,
                'name' => 'worker.reach_destination',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:47',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'feature_id' => 1,
                'name' => 'worker.resume',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:34:59',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'feature_id' => 1,
                'name' => 'worker_resume.print_normal',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:35:06',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'feature_id' => 1,
                'name' => 'worker_resume.print_party',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:35:12',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'feature_id' => 1,
                'name' => 'worker_resume.print_internal',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:35:19',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'feature_id' => 1,
                'name' => 'worker.interview',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:35:50',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'feature_id' => 1,
                'name' => 'worker.interview_print',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:35:57',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'feature_id' => 1,
                'name' => 'worker.save_interview',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:05',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'feature_id' => 1,
                'name' => 'worker.history',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:11',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'feature_id' => 2,
                'name' => 'worker.create_step_one',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:30',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'feature_id' => 2,
                'name' => 'worker.find',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:35',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'feature_id' => 2,
                'name' => 'worker.create_step_two',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:42',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'feature_id' => 2,
                'name' => 'worker.save_step_2',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:48',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'feature_id' => 2,
                'name' => 'worker.create_step_three',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:36:55',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'feature_id' => 2,
                'name' => 'worker.save_step_3',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:01',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'feature_id' => 2,
                'name' => 'worker.save_all_step',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:07',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'feature_id' => 2,
                'name' => 'worker.save_invoice',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:15',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'feature_id' => 3,
                'name' => 'worker.edit_step_one',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:26',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'feature_id' => 3,
                'name' => 'worker.update_step_1',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:32',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'feature_id' => 3,
                'name' => 'worker.edit_step_two',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:38',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'feature_id' => 3,
                'name' => 'worker.update_step_2',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:44',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'feature_id' => 3,
                'name' => 'worker.edit_step_three',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:50',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'feature_id' => 3,
                'name' => 'worker.update_step_3',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:37:57',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'feature_id' => 3,
                'name' => 'worker.update_all_step',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:38:03',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'feature_id' => 5,
                'name' => 'worker.withdraw_passport',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:38:55',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'feature_id' => 5,
                'name' => 'worker.remove_by_company',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:39:02',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'feature_id' => 5,
                'name' => 'worker.put_to_blacklist',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:39:29',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'feature_id' => 6,
                'name' => 'worker.put_to_prepare',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:40:22',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'feature_id' => 6,
                'name' => 'worker.put_to_get_ready',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:40:37',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'feature_id' => 6,
                'name' => 'worker.put_to_delay',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:40:44',
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'feature_id' => 6,
                'name' => 'worker.put_to_reach_destination',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:40:50',
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'feature_id' => 7,
                'name' => 'worker_verification.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:42:13',
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'feature_id' => 8,
                'name' => 'worker_verification.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:42:23',
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'feature_id' => 8,
                'name' => 'worker_verification.update',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:42:30',
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'feature_id' => 9,
                'name' => 'agency.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:43:38',
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'feature_id' => 10,
                'name' => 'agency.save',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:43:50',
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'feature_id' => 11,
                'name' => 'agency.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:44:00',
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'feature_id' => 11,
                'name' => 'agency.update',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:44:07',
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'feature_id' => 12,
                'name' => 'agency.delete',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:44:14',
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'feature_id' => 13,
                'name' => 'invoice.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:45:24',
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'feature_id' => 13,
                'name' => 'invoice.print',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:45:30',
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'feature_id' => 14,
                'name' => 'invoice.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:45:42',
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'feature_id' => 14,
                'name' => 'invoice.add_item',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:45:49',
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'feature_id' => 14,
                'name' => 'invoice.edit_item',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:45:54',
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'feature_id' => 14,
                'name' => 'invoice.update_item',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:46:00',
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'feature_id' => 13,
                'name' => 'invoice.payment_receipt',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:46:57',
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'feature_id' => 15,
                'name' => 'invoice.payment',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:47:07',
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'feature_id' => 15,
                'name' => 'invoice.save_payment',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:47:13',
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'feature_id' => 16,
                'name' => 'setting.user.index',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:48:57',
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'feature_id' => 17,
                'name' => 'setting.user.save',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:49:08',
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'feature_id' => 17,
                'name' => 'setting.user.edit',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:49:17',
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'feature_id' => 18,
                'name' => 'setting.user.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:49:48',
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'feature_id' => 18,
                'name' => 'setting.user.update',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:49:53',
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'feature_id' => 19,
                'name' => 'user.delete',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:50:10',
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'feature_id' => 20,
                'name' => 'settings',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:52:09',
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'feature_id' => 21,
                'name' => 'setting.group.index',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 14:59:17',
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'feature_id' => 22,
                'name' => 'settings.group.create',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:59:41',
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'feature_id' => 22,
                'name' => 'settings.group.save',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:59:45',
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'feature_id' => 23,
                'name' => 'settings.group.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:59:55',
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'feature_id' => 23,
                'name' => 'settings.group.update',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 14:59:59',
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'feature_id' => 24,
                'name' => 'settings.group.delete',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-22 15:00:10',
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'feature_id' => 25,
                'name' => 'setting.user_factory_branch.index',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 17:01:08',
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'feature_id' => 26,
                'name' => 'setting.user_factory_branch.create',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 17:01:17',
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'feature_id' => 26,
                'name' => 'setting.user_factory_branch.save',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 17:01:20',
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'feature_id' => 27,
                'name' => 'setting.user_factory_branch.edit',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 17:01:27',
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'feature_id' => 27,
                'name' => 'setting.user_factory_branch.update',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 17:01:31',
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'feature_id' => 28,
                'name' => 'setting.user_factory_branch.delete',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-01-22 17:01:39',
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'feature_id' => 4,
                'name' => 'worker.delete',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-23 14:05:47',
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'feature_id' => 3,
                'name' => 'worker.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-31 22:38:36',
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'feature_id' => 5,
                'name' => 'worker.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-31 22:38:56',
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'feature_id' => 6,
                'name' => 'worker.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-01-31 22:39:08',
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'feature_id' => 6,
                'name' => 'worker.put_to_cancel',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-01 20:30:22',
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'feature_id' => 29,
                'name' => 'worker_passport_expired.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-06 14:57:10',
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'feature_id' => 30,
                'name' => 'report.income',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-06 15:36:23',
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'feature_id' => 1,
                'name' => 'worker_resume.registration_form',
                'created_by' => 1,
                'updated_by' => 1,
                'active' => 1,
                'created_at' => '2024-02-07 09:31:28',
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'feature_id' => 31,
                'name' => 'expense.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:25:58',
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'feature_id' => 32,
                'name' => 'expense.save',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:26:22',
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'feature_id' => 33,
                'name' => 'expense.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:26:29',
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'feature_id' => 33,
                'name' => 'expense.update',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:26:33',
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'feature_id' => 34,
                'name' => 'expense.delete',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:26:39',
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'feature_id' => 30,
                'name' => 'report.expense',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-07 10:40:36',
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'feature_id' => 35,
                'name' => 'worker.import',
                'created_by' => 1,
                'updated_by' => NULL,
                'active' => 1,
                'created_at' => '2024-02-13 20:45:32',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}