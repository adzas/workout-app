<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkoutSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setName = 'Workout 1';
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
                'repeat' => 3,
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
                'rows' => '12/10/10/8',
                'name' => 'Back squat',
                'link' => 'https://www.youtube.com/watch?v=_gTM-oBKHw0',
                'description' => '30	@RIR1-2	',
            ],
            [
                'config_workout_series_id' => $seriesIdA,
                'order'=> 2,
                'rows' => '12/10/10/8',
                'name' => 'Incline db bench press',
                'link' => 'https://www.youtube.com/watch?v=Fv5EYoJfRt4',
                'description' => '120	@RIR1-2	Skos ok 30 stopni',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 1,
                'rows' => '10 ES',
                'name' => 'KB Walking lunges',
                'link' => 'https://www.youtube.com/watch?v=OFSepehKEsg',
                'description' => '30	Na ostatnich metrach ma być ciężko	',
            ],
            [
                'config_workout_series_id' => $seriesIdB,
                'order'=> 2,
                'rows' => '10',
                'name' => 'Ring / TRX row',
                'link' => 'https://www.youtube.com/watch?v=Xcs5BDXrO_A',
                'description' => '90	@RIR0-1	',
            ],
            [
                'config_workout_series_id' => $seriesIdC,
                'order'=> 1,
                'rows' => '10-12 ES',
                'name' => 'Landmine press',
                'link' => 'https://www.youtube.com/watch?v=5Cs27w8WVz4',
                'description' => '0	@RIR1-2	',
            ],
            [
                'config_workout_series_id' => $seriesIdC,
                'order'=> 2,
                'rows' => '10',
                'name' => 'Heavy Slam ball (throw behind)',
                'link' => 'https://www.youtube.com/watch?v=fbJKXfCI-JA',
                'description' => '90	PIŁKA - min. 20-30kg	',
            ],
            [
                'config_workout_series_id' => $seriesIdD,
                'order'=> 1,
                'rows' => 'AMRAP',
                'name' => 'Seated Calf raises',
                'link' => 'https://www.youtube.com/shorts/gpXQwBBzRz0',
                'description' => '0	@RIR0	',
            ],
            [
                'config_workout_series_id' => $seriesIdD,
                'order'=> 2,
                'rows' => 'AMRAP',
                'name' => 'Hanging knee raises',
                'link' => 'https://www.youtube.com/watch?v=KYwP30AD_h0',
                'description' => '60	@RIR0	',
            ],
        ];
        DB::table('config_workout_exercises')->insert($exercises);
    }
}
