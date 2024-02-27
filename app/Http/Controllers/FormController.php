<?php

namespace App\Http\Controllers;

use App\Models\WorkoutSet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * awailable workset list
     */
    public function showWorkoutSets()
    {
        session()->remove('message');
        $workout_sets = DB::table('config_workout')->get();

        return view('welcome', ['workout_sets' => $workout_sets]);
    }

    /**
     * display exercises list by workset id
     */
    public function showExercisesByWorkoutSetID(int $config_workout_id)
    {
        $workout_exercises = DB::table('config_workout_exercises', 'm')
            ->join('config_workout_series','config_workout_series.id','=','m.config_workout_series_id')
            ->select('config_workout_series.name as series', 'm.*', 'config_workout_series.config_workout_id')
            ->where('config_workout_id', $config_workout_id)
            ->orderBy('config_workout_series.order')
            ->orderBy('m.order')
            ->get();

        return view('exercises_list', ['workout_exercises' => $workout_exercises]);
    }

    /**
     * display exercises list by workset id
     */
    public function showExercise(int $exercise_id)
    {
        $exercise = DB::table('config_workout_exercises', 'm')
            ->join('config_workout_series','config_workout_series.id','=','m.config_workout_series_id')
            ->select('config_workout_series.name as series', 'm.*', 'config_workout_series.config_workout_id')
            ->where('m.id', $exercise_id)
            ->get()
            ->first();

        return view('exercise_show', ['exercise' => $exercise]);
    }

    /**
     * create a workout_exercises_work row
     */
    public function startWorkout(int $workout_set_id)
    {
        $mWorkoutSet = new WorkoutSet();
        $workout_id = $mWorkoutSet->startWorkout($workout_set_id);

        $url = route('exercise_to_work', ['workout_id' => $workout_id]);

        return redirect($url);
    }

    public function exerciseToWork(int $workout_id)
    {
        $mWorkoutSet = new WorkoutSet();
        $exerciseInWork = $mWorkoutSet->nextExerciseToWork($workout_id);
        if (null === $exerciseInWork) {
            session()->put('message', 'Trening ukończony! Dane zostały zapisane.');
            $url = route('end_workout', ['workout_id' => $workout_id]);
    
            return redirect($url);
        }

        return view('exercise_edit', ['exerciseInWork' => $exerciseInWork]);
    }

    /**
     * 
     */
    public function workExercise(Request $request)
    {
        DB::table('workout_row')
        ->where('id', $request->input('id'))
        ->update([
            'result' => $request->input('result'), 
            'description' => $request->input('description'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('workout')
        ->where('id', $request->input('workout_id'))
        ->update([
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $url = route('exercise_to_work', ['workout_id' => $request->input('workout_id')]);

        return redirect($url);
    }

    public function endWorkout(int $workout_id)
    {
        $workout_report = DB::table('workout')
        ->where('id', $workout_id)
        // SECOND, MINUTE, HOUR, DAY, MONTH, YEAR i
        // ->select('TIMESTAMPDIFF(MINUTE, created_at, updated_at) AS time')
        ->select(DB::raw('TIMESTAMPDIFF(MINUTE, created_at, updated_at) AS time'))
        ->get()
        ->first();

        return view('workout_report', ['workout_report' => $workout_report]);
    }
}
