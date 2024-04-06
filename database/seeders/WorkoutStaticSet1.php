<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutStaticSet1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setName = 'Static Set 1';
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
                'repeat' => 3,
                'order'=> 1,
                'name'=> $seriesA,
            ],
            [
                'config_workout_id' => $setId,
                'repeat' => 5,
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
                'rows' => '20s ES',
                'name' => 'Yielding iso split squat',
                'link' => 'https://www.youtube.com/watch?v=0sukKOLZ3z8',
                'description' => 'rest: 30s',
            ],
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 2,
                'rows' => '15-30s',
                'name' => 'Yielding iso push ups',
                'link' => 'https://www.youtube.com/watch?v=hkImOR_HNjo',
                'description' => 'rest 30s',
            ],
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 3,
                'name' => 'Side plank',
                'link' => '#',
                'rows' => '20-30s ES',
                'description' => 'rest: 120s',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 1,
                'name' => 'Arch Hold',
                'link' => 'https://www.youtube.com/watch?v=wQdKFbKKjcI',
                'rows' => '30s',
                'description' => 'rest: 30s',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 2,
                'name' => 'Wall sit',
                'link' => 'https://www.youtube.com/watch?v=SszDMOZvFuw',
                'rows' => '60s',
                'description' => 'rest: 90s',
            ]
        ];
        DB::table('config_workout_exercises')->insert($exercises);
    }
}
