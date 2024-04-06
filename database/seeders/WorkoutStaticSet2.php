<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutStaticSet2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setName = 'Static Set 2';
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
                'name' => 'Air squats',
                'link' => 'https://www.youtube.com/watch?v=hOzIP_sDfU0',
                'rows' => '15',
                'description' => 'tempo: 3111, odpoczynek: 30s',
            ],
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 2,
                'name' => 'Push up',
                'rows' => 'AMRAP',
                'link' => 'https://www.youtube.com/watch?v=_l3ySVKYVJ8',
                'description' => 'tempo: 3111, odpoczynek: 30s',
            ],
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 3,
                'name' => 'Cossack squat',
                'link' => 'https://www.youtube.com/watch?v=dhDjKmTX8tU',
                'rows' => '10 ES',
                'description' => 'tesmpo: 2121, odpoczynek:	120s',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 1,
                'name' => 'Reverse snow angels',
                'link' => 'https://youtu.be/FWaLM-RDvVs?si=xbM5KnArVUtKLhjx',
                'rows' => '10-15',
                'description' => 'tempo: Powoli, rest: 30s',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 2,
                'name' => 'Russian twist',
                'link' => 'https://www.youtube.com/watch?v=NmzEBlYTR0s',
                'rows' => '15 ES',
                'description' => 'odpoczynek: 90s',
            ]
        ];
        DB::table('config_workout_exercises')->insert($exercises);
    }
}
