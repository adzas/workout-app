<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>AGames</title>
    </head>
    <body class="antialiased">

    <h1>Szczegóły treningu:</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
    {{ $my_workout->date }}
    <br>
    czas treningu: {{ $my_workout->time }} min

    <br>

    <table>
        <thead>
            <tr>
                <th>lp</th>
                <th>ćwiczenie</th>
                <th>Wynik</th>
                <th>Opis</th>
                <th>Uwagi</th>
            </tr>
        </thead>
        <tbody>
    @foreach($my_rows as $i => $row)

            <tr>
                <td>{{$i+1}}</dt>
                <td>{{$row->exercise_name}}</dt>
                <td>{{$row->result}}</dt>
                <td>{{$row->exercise_description}}</dt>
                <td>{{$row->description}}</dt>
            </tr>

    @endforeach
        </tbody>
    </table>

    <br>
    <br>
    <a href="{{ url('/') }}">Wróć do treningów</a>

    </body>
</html>
