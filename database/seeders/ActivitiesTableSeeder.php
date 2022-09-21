<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Carbon\Carbon;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activity = new Activity;
        $activity->session_id = 1;
        $activity->method_id = 1;
        $activity->title = 'Introduction to TIC Industry';
        $activity->start = Carbon::createFromFormat('d/m/Y H:i:s', '03/01/2022 00:00:00');
        $activity->finish = Carbon::createFromFormat('d/m/Y H:i:s', '05/01/2022 00:00:00');
        $activity->save();
    }
}
