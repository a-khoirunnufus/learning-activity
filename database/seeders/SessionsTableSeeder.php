<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->insert([
            'title' => 'Year 1', 
            'year' => 2022, 
            'month_begin' => 1,
            'month_end' => 6,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);
    }
}
