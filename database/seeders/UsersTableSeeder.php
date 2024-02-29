<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'amdin@gmail.com',
                'email_verified_at' => NULL,
                'username' => 'admin',
                'password' => '$2y$10$hvDxbcuGzDGC1yoxiGcAB.mSqrMZgsUBUYjewwirweUEenVY6adSa',
                'role_id' => 0,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'សំ រិទ្ធី',
                'email' => 'rithysam2019@gmail.com',
                'email_verified_at' => NULL,
                'username' => 'rithy.sam',
                'password' => '$2y$10$4aPpefiWTLryQ6USKDg43uafLJ8Lq2TFdWgkk2tH8/9UjCaKDFN0m',
                'role_id' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-11-20 08:32:21',
                'updated_at' => NULL,
                'active' => 1,
            ),
        ));
        
        
    }
}