<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
    // return redirect('home');
// });

Route::get('/', [FormController::class, 'showWorkoutSets'])->name('show_workout_sets');
Route::get('/end_workout/{workout_id}', [FormController::class, 'endWorkout'])->name('end_workout');
Route::get('/workout_exercises_show/{id}', [FormController::class, 'showExercisesByWorkoutSetID'])->name('workout_exercises_show');
Route::get('/exercise_show/{id}', [FormController::class, 'showExercise'])->name('exercise_show');
Route::get('/workout_start/{workout_set_id}', [FormController::class, 'StartWorkout'])->name('workout_start');
Route::get('/exercise_to_work/{workout_id}', [FormController::class, 'exerciseToWork'])->name('exercise_to_work');
Route::post('/exercise_work', [FormController::class, 'workExercise'])->name('exercise_work');

Route::get('/workout_exercises_history/{id}', [FormController::class, 'showExercisesHistoryByWorkoutID'])->name('workout_exercises_history');
Route::get('/my_workout_details/{id}', [FormController::class, 'showMyWorkoutDetailsByID'])->name('my_workout_details');