<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutSetForTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setName = 'Workout set for test';
        DB::table('config_workout')->insert([[
            'order'=> 1,
            'name' => $setName,
        ]]);

        $setId = DB::table('config_workout')->where('name', $setName)->value('id');

        $seriesA = 'A';
        $seriesB = 'B';

        $series = [
            [
                'config_workout_id' => $setId,
                'repeat' => 2,
                'order'=> 1,
                'name'=> $seriesA,
            ],
            [
                'config_workout_id' => $setId,
                'repeat' => 2,
                'order'=> 2,
                'name'=> $seriesB,
            ],
        ];
        DB::table('config_workout_series')->insert($series);
        $seriesIdA = DB::table('config_workout_series')->where('name', $seriesA)->where('config_workout_id', $setId)->value('id');
        $seriesIdB = DB::table('config_workout_series')->where('name', $seriesB)->where('config_workout_id', $setId)->value('id');

        $exercises = [
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 1,
                'rows' => '10',
                'name' => 'Pompki',
                'link' => '#',
                'description' => '60s odpoczynek',
            ],
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 2,
                'rows' => '4-6',
                'name' => 'przysiady',
                'link' => 'https://www.youtube.com/watch?v=cd_38C6LuvY',
                'description' => '180s odpoczynek (wideo przykładowe)',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 1,
                'rows' => '30s',
                'name' => 'deska',
                'link' => '#',
                'description' => '30s',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 2,
                'rows' => '2',
                'name' => 'Padnij-powstań',
                'link' => 'https://www.youtube.com/watch?v=9vcKpv45aeE',
                'description' => '120s odpoczynku (wideo dla przykładu)',
            ],
        ];
        DB::table('config_workout_exercises')->insert($exercises);
    }
}
