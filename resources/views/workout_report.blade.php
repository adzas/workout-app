<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AGames</title>
    </head>
    <body class="antialiased">

    <h1>Podsumowanie treningu:</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
    <br>
    czas treningu: {{ $workout_report->time }} min

    <br>
    <a href="{{ url('/') }}">Wróć do treningów</a>

    </body>
</html>
