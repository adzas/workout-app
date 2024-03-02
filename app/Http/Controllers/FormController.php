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
        // TODO: move to link separator
        $V_ID = null;
        $parts = explode('v=', $exercise->link);
        if (isset($parts[1])) {
            $V_ID = $parts[1];
        }

        return view('exercise_show', ['exercise' => $exercise, 'V_ID' => $V_ID]);
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
        // TODO: move to link separator
        $V_ID = null;
        $parts = explode('v=', $exerciseInWork->exercise_link);
        if (isset($parts[1])) {
            $V_ID = $parts[1];
        }

        return view('exercise_edit', ['exerciseInWork' => $exerciseInWork, 'V_ID' => $V_ID]);
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

    public function showExercisesHistoryByWorkoutID(int $config_workout_id)
    {
        $my_workouts = DB::table('workout')
        ->where('config_workout_id', $config_workout_id)
        ->select(DB::raw('TIMESTAMPDIFF(MINUTE, created_at, updated_at) AS time'), 'id', 'date')
        ->limit(25)
        ->get();

        return view('workout_history', ['my_workouts' => $my_workouts]);
    }

    public function showMyWorkoutDetailsByID(int $workout_id)
    {
        $my_workout = DB::table('workout')
        ->where('id', $workout_id)
        ->select(DB::raw('TIMESTAMPDIFF(MINUTE, created_at, updated_at) AS time'), 'id', 'date')
        ->get()
        ->first();

        $my_rows = DB::table('workout_series', 'm')
        ->join('workout_row','workout_row.workout_series_id','=','m.id')
        ->join('config_workout_exercises','workout_row.config_workout_exercises_id','=','config_workout_exercises.id')
        ->where('m.workout_id', $workout_id)
        ->select(
            DB::raw('TIMESTAMPDIFF(MINUTE, workout_row.created_at, workout_row.updated_at) AS time'),
            'workout_row.updated_at as row_date',
            'workout_row.result as result',
            'workout_row.description as description',
            'config_workout_exercises.rows as exercise_row',
            'config_workout_exercises.name as exercise_name',
            'config_workout_exercises.link as exercise_link',
            'config_workout_exercises.description as exercise_description',
        )
        ->orderBy('m.id')
        ->orderBy('workout_row.id')
        ->get();

        return view('my_workout_details', ['my_workout' => $my_workout, 'my_rows' => $my_rows]);
    }
}
