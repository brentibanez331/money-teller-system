<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_transaction_fees')->insert([
            ['id' => 1, 'min_amt' => 1, 'max_amt' => 1000, 'rates' => 20],
            ['id' => 2, 'min_amt' => 1001, 'max_amt' => 5000, 'rates' => 50],
            ['id' => 3, 'min_amt' => 5001, 'max_amt' => 10000, 'rates' => 75],
            ['id' => 4, 'min_amt' => 10001, 'max_amt' => 20000, 'rates' => 100],
            ['id' => 5, 'min_amt' => 20001, 'max_amt' => 30000, 'rates' => 120],
            ['id' => 6, 'min_amt' => 30001, 'max_amt' => 40000, 'rates' => 150],
            ['id' => 7, 'min_amt' => 40001, 'max_amt' => 50000, 'rates' => 180],
        ]);
    }
}
