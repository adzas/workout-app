<?php

namespace App\Models;

use App\Interfaces\ExerciseInWorkInterface;

class ExerciseInWork implements ExerciseInWorkInterface
{
    public int $id;
    public int $row_id;
    public int $series_id;
    public int $exercise_id;
    public string $exercise_rows;
    public string $exercise_description;
}
