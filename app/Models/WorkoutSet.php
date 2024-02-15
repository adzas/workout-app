<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ExerciseInWork;

class WorkoutSet extends Model
{
    protected $table = 'config_workout';
    // Dodaj inne właściwości i metody modelu, jeśli to konieczne

    /**
     * return workout_id
     */
    public function startWorkout(int $config_workout_id): int
    {
        // created workout by workout set id
        $workout_to_insert = [
            'config_workout_id' => $config_workout_id,
            'date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $workout_id = DB::table('workout')->insertGetId($workout_to_insert);

        // get config set
        $series_set = DB::table('config_workout_series', 'm')
        ->where('m.config_workout_id', $config_workout_id)
        ->orderBy('m.order')
        ->select('m.id','m.repeat')
        ->get();

        foreach ($series_set as $series) {
            // create series for workout
            $workout_series_to_insert = [
                'workout_id' => $workout_id,
                'date' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $series_id = DB::table('workout_series')->insertGetId($workout_series_to_insert);
            
            $exercises_set = DB::table('config_workout_exercises', 'm')
            ->join('config_workout_series','config_workout_series.id','=','m.config_workout_series_id')
            ->where('m.config_workout_series_id', $series->id)
            ->orderBy('m.order')
            ->orderBy('config_workout_series.order')
            ->select('m.id')
            ->get();
            $workout_exercises_to_insert = [];
            for ($i=0; $i < $series->repeat; $i++) {
                foreach ($exercises_set as $exercises) {
                    $workout_exercises_to_insert[] = [
                        'workout_series_id' => $series_id,
                        'config_workout_exercises_id' => $exercises->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'row_number' => $i,
                    ];
                }
            }
            DB::table('workout_row')->insert($workout_exercises_to_insert);
        }

        return $workout_id;
    }

    /**
     * return exercise row id
     */
    public function nextExerciseToWork(int $workout_id): \stdClass|null
    {
        $workout_row = DB::table('workout')
            ->join('workout_series','workout.id','=','workout_series.workout_id')
            ->join('workout_row','workout_row.workout_series_id','=','workout_series.id')
            ->join('config_workout_exercises', 'workout_row.config_workout_exercises_id','=','config_workout_exercises.id')
            ->where('workout.id', $workout_id)
            ->whereNull('workout_row.result')
            ->select(
                'workout_row.id as row_id',
                'workout_series.id as series_id',
                'workout.id as id',
                'workout_row.config_workout_exercises_id as exercise_id',
                'config_workout_exercises.id as exercise_id',
                'config_workout_exercises.name as exercise_name',
                'config_workout_exercises.rows as exercise_rows',
                'config_workout_exercises.description as exercise_description',
            )
            ->get()
            ->first();

        return $workout_row;
    }
}
