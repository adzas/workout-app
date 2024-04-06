<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>AGames</title>
    </head>
    <body class="antialiased">

    <h1>Lista treningów:</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
    @foreach($workout_sets as $workout)

    <div class="click-element">
        <a href="{{ url('workout_exercises_show', ['id' => $workout->id]) }}">{{$workout->name}}</a>
        -
        <a href="{{ url('workout_exercises_history', ['id' => $workout->id]) }}">historia treningów</a>
    </div>

    @endforeach
    
    </body>
</html>
