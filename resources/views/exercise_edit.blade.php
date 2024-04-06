<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>AGames</title>

    </head>
    <body class="antialiased">

    <h1>{{ $exerciseInWork->exercise_name }}</h1>

    <?php
        $pDone = ( $done / $all ) * 100;
    ?>
    <div style="border: 1px solid lightgray;">
      <div style="background-color:#383;height:2px;width:{{$pDone}}%"></div>
    </div>
    <div style="width: 100%; text-align:right; font-size:.8em;">
    <span style="">{{$done . '/' . $all}}</span>
    </div>

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
        <input type="text" id="result" name="result" autocomplete="off" required autofocus>
        <br>
        <!-- TIMER --> 
        <div id="timer">00:00:00</div>
        <div id="controls">
            <button type="button" onclick="start()">Start</button>
            <button type="button" onclick="stop()">Stop</button>
            <button type="button" onclick="reset_()">Reset</button>
        </div>
        <br>
        <textarea placeholder="dodatkowe uwagi" id="description" name="description" rows="4" ></textarea>
        <br>
        @if (null !== $V_ID)
            <details>
                <summary>zobacz</summary>
                <p>
                    <a href="{{ $exerciseInWork->exercise_link }}" target="_blank" rel="noopener noreferrer">zobacz</a>
                    <iframe width="100%" height="auto" src="https://www.youtube.com/embed/{{$V_ID}}" frameborder="0" allowfullscreen></iframe>
                </p>
            </details>
        @else
            <a href="{{ $exerciseInWork->exercise_link }}" target="_blank" rel="noopener noreferrer">zobacz</a>
        @endif
        <br>

        <button type="submit">Wyślij</button>
    </form>
    
    <!-- TIMER SCRIPTS -->
    <script>
        let timerInterval;
        let milliseconds = 0, seconds = 0, minutes = 0;
        
        function start() {
            clearInterval(timerInterval);
            timerInterval = setInterval(updateTimer, 10); // Aktualizuj co 10 milisekund
        }
        
        function stop() {
            clearInterval(timerInterval);
        }
        
        function reset_() {
            console.log('test');
            clearInterval(timerInterval);
            milliseconds = 0;
            seconds = 0;
            minutes = 0;
            document.getElementById("timer").innerText = "00.00.00";
        }
        
        function updateTimer() {
            milliseconds++;
            if (milliseconds >= 99) {
                milliseconds = 0;
                seconds++;
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                }
            }
            const formattedTime = pad(minutes) + ":" + pad(seconds) + "." + pad(milliseconds, 2);
            document.getElementById("timer").innerText = formattedTime;
        }
        
        function pad(val, length = 2) {
            let valString = val + "";
            while (valString.length < length) {
                valString = "0" + valString;
            }
            return valString;
        }
        
        </script>
    </body>
</html>
