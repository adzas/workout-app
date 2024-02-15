<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AGames</title>
        
    </head>
    <body class="antialiased">

    <h1>{{ $exercise->name }}:</h1>

    <h3>seria {{ $exercise->series }}</h3>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
    <p>
        {{ $exercise->rows }}
        <br/>
        {{ $exercise->description }}
        <br/>
        <a href="{{ $exercise->link }}" target="_blank" rel="noopener noreferrer">zobacz</a>
    </p>
    
    </body>
</html>
