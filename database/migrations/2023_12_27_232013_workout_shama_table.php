<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * ...
         */
        Schema::create('config_workout', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('order');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('config_workout_series', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('order');
            $table->tinyInteger('repeat');
            $table->unsignedBigInteger('config_workout_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('config_workout_id')->references('id')->on('config_workout');
        });
        Schema::create('config_workout_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('config_workout_series_id');
            $table->tinyInteger('order');
            $table->string('rows');
            $table->string('name');
            $table->string('link');
            $table->string('description');
            $table->timestamps();

            $table->foreign('config_workout_series_id')->references('id')->on('config_workout_series');
        });
        Schema::create('workout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('config_workout_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('config_workout_id')->references('id')->on('config_workout');
        });
        Schema::create('workout_series', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_id');
            $table->date('date');
            $table->timestamps();
            
            $table->foreign('workout_id')->references('id')->on('workout');
        });
        Schema::create('workout_row', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_series_id');
            $table->unsignedBigInteger('config_workout_exercises_id');
            $table->tinyInteger('row_number');
            $table->string('result')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('workout_series_id')->references('id')->on('workout_series');
            $table->foreign('config_workout_exercises_id')->references('id')->on('config_workout_exercises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIdExists('workout_set');
        Schema::dropIdExists('workout_exercises');
        Schema::dropIdExists('workout_exercises_work');
        Schema::dropIdExists('workout_exercises_work_row');
    }
};
