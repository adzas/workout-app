<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutSet2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setName = 'Workout set 2';
        DB::table('config_workout')->insert([[
            'order'=> 1,
            'name' => $setName,
        ]]);

        $setId = DB::table('config_workout')->where('name', $setName)->value('id');

        $seriesA = 'A';
        $seriesB = 'B';
        $seriesC = 'C';
        $seriesD = 'D';

        $series = [
            [
                'config_workout_id' => $setId,
                'repeat' => 4,
                'order'=> 1,
                'name'=> $seriesA,
            ],
            [
                'config_workout_id' => $setId,
                'repeat' => 3,
                'order'=> 2,
                'name'=> $seriesB,
            ],
            [
                'config_workout_id' => $setId,
                'repeat' => 3,
                'order'=> 3,
                'name'=> $seriesC,
            ],
            [
                'config_workout_id' => $setId,
                'repeat' => 4,
                'order'=> 4,
                'name'=> $seriesD,
            ]
        ];
        DB::table('config_workout_series')->insert($series);
        $seriesIdA = DB::table('config_workout_series')->where('name', $seriesA)->where('config_workout_id', $setId)->value('id');
        $seriesIdB = DB::table('config_workout_series')->where('name', $seriesB)->where('config_workout_id', $setId)->value('id');
        $seriesIdC = DB::table('config_workout_series')->where('name', $seriesC)->where('config_workout_id', $setId)->value('id');
        $seriesIdD = DB::table('config_workout_series')->where('name', $seriesD)->where('config_workout_id', $setId)->value('id');

        $exercises = [
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 1,
                'rows' => 'RAMPA do 3RM',
                'name' => 'Back squat',
                'link' => 'https://www.youtube.com/watch?v=_gTM-oBKHw0',
                'description' => '120-180	@RIR1',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 1,
                'rows' => '4-6',
                'name' => 'Incline db bench press',
                'link' => 'https://www.youtube.com/watch?v=cd_38C6LuvY',
                'description' => '30	@RIR1',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 2,
                'rows' => '4-6',
                'name' => 'Dipy',
                'link' => 'https://www.youtube.com/watch?v=JR0PUrVAFyA',
                'description' => '120	@RIR1',
            ],
            [
                'config_workout_series_id' => $seriesIdC,
                'order'=> 2,
                'rows' => '6-8',
                'name' => 'DB floor press',
                'link' => 'https://www.youtube.com/watch?v=9vcKpv45aeE',
                'description' => '120	@RIR1',
            ],
            [
                'config_workout_series_id' => $seriesIdC,
                'order'=> 1,
                'rows' => '5',
                'name' => 'Pendlay row',
                'link' => 'https://www.youtube.com/watch?v=EzFkN5ge5_k',
                'description' => '',
            ],
            [
                'config_workout_series_id' => $seriesIdD,
                'order'=> 1,
                'rows' => '5 ES',
                'name' => 'KB Bulgarian split squat',
                'link' => 'https://www.youtube.com/watch?v=8BLIcCExK4I',
                'description' => '',
            ],
            [
                'config_workout_series_id' => $seriesIdD,
                'order'=> 2,
                'rows' => '30s',
                'name' => 'GHD Sit-up Isometric Hold',
                'link' => 'https://youtu.be/C2PUSUr793w?si=NeLQIwuXCsuIWQBa',
                'description' => '0	@RIR0	',
            ],
            [
                'config_workout_series_id' => $seriesIdD,
                'order'=> 3,
                'rows' => 'AMRAP',
                'name' => 'Burpees',
                'link' => '#',
                'description' => 'padnij powstań - 90s',
            ],
        ];
        DB::table('config_workout_exercises')->insert($exercises);
    }
}
