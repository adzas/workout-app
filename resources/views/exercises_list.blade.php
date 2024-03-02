<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>AGames</title>
        
    </head>
    <body class="antialiased">

    <h1>Lista ćwiczeń</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    @foreach ($workout_exercises as $exercise)

        <label>seria: {{ $exercise->series }}</label>
        <a href="{{ url('exercise_show', ['id' => $exercise->id]) }}">{{ $exercise->name }}</a>
        <br>
        
    @endforeach

    <br/>
    <a href="{{ url('workout_start', ['workout_set_id' => $exercise->config_workout_id]) }}">Rozpocznij trening</a>
    
    </body>
</html>
