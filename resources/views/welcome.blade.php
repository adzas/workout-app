<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AGames</title>
    </head>
    <body class="antialiased">

    <h1>Lista treningów:</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
    @foreach($workout_sets as $workout)

        <a href="{{ url('workout_exercises_show', ['id' => $workout->id]) }}">{{$workout->name}}</a>

    @endforeach
    
    </body>
</html>
