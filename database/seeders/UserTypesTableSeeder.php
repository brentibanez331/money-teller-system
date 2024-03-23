<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tbl_user_types')->insert([
            ['id' => 1, 'user_type' => 'admin'],
            ['id' => 2, 'user_type' => 'teller'],
        ]);

        DB::table('users')->insert([
            ['id' => 1, 'first_name' => 'Administrator', 'middle_name' => '', 'last_name' => '', 'email' => 'admin@gmail.com', 
            'password' => Hash::make('admin123'), 'birthdate'=>null, 'balance'=>null, 'full_address'=>'',  'user_type_id' => 1, 'branch_assigned' => 1]
        ]);
    }
}
