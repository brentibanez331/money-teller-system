<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_branch_profile')->insert([
            ['id' => 1, 'branch_name' => 'Pera Padala BCD', 'branch_code' => 'PH-BCD', 'country_iso_code' => 'PH'],
            ['id' => 2, 'branch_name' => 'Pera Padala LC', 'branch_code' => 'PH-LC', 'country_iso_code' => 'PH'],
            ['id' => 3, 'branch_name' => 'Pera Padala US', 'branch_code' => 'US-CA', 'country_iso_code' => 'US'],
        ]);
    }
}
