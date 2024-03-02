<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>AGames</title>
    </head>
    <body class="antialiased">

    <h1>Moje treningi:</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
    <table >
        <thead>
            <tr>
                <th>lp</th>
                <th>data</th>
                <th>czas</th>
                <th>szczegóły</th>
            </tr>
        </thead>
        <tbody>
    @foreach($my_workouts as $i => $workout)

            <tr>
                <td>{{$i+1}}</dt>
                <td>{{$workout->date}}</dt>
                <td>{{$workout->time}}</dt>
                <td>
                    <a class="click-element" href="{{ url('my_workout_details', ['id' => $workout->id]) }}">klick</a>
                </td>
            </tr>

    @endforeach
        </tbody>
    </table>
    
    </body>
</html>
