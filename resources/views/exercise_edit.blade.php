<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AGames</title>
        
    </head>
    <body class="antialiased">

    <h1>{{ $exerciseInWork->exercise_name }}</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form method="post" action="{{ route('exercise_work') }}">
        @csrf <!-- Dodaj token CSRF do formularza -->
        <input hidden="true" type="number" id="id" name="id" value="{{ $exerciseInWork->row_id }}" required>
        <input hidden="true" type="number" id="exercise_id" name="exercise_id" value="{{ $exerciseInWork->exercise_id }}" required>
        <input hidden="true" type="number" id="workout_id" name="workout_id" value="{{ $exerciseInWork->id }}" required>
        <input hidden="true" type="number" id="series_id" name="series_id" value="{{ $exerciseInWork->series_id }}" required>

        <h3>{{ $exerciseInWork->exercise_rows }}</h3>
        <h5>{{ $exerciseInWork->exercise_description }}</h5>
        <label for="name">wyniki:</label>
        <br>
        <input type="text" id="result" name="result" required>
        <br>
        <textarea placeholder="dodatkowe uwagi" id="description" name="description" rows="4" ></textarea>
        <br>
        <br>

        <button type="submit">Wyślij</button>
    </form>
    
    </body>
</html>
