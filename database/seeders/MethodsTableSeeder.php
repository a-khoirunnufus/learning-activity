<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_methods')->insert([
            ['name' => 'Workshop/Self Learning', 'order' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => "Sharing Practice/Professinal's Talk", 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Discussion room', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coaching', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mentoring', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Job Assignment', 'order' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
