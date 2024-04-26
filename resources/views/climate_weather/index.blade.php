<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Clima</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        h1, h2 {
            text-align: center;
            margin: 20px 0;
        }
        form, .content {
            text-align: left;
            margin: 0 auto;
            width: fit-content;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .alert {
            color: red;
            padding: 5px 10px;
        }
        .navigation {
            margin-top: 20px;
            text-align: center;
        }
        input[type="text"], button {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Informações do Clima</h1>
    <div class="content">
        <form action="{{ url('/') }}" method="GET">
            <input type="text" name="city" placeholder="Digite a cidade" required>
            <button type="submit">Buscar Clima</button>
        </form>
        <div id="loading" style="display: none; text-align: center;">
            Carregando...
        </div>
        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif
        @if (isset($weatherStatus) && !$weatherStatus)
            <p>{{$weatherMsg}}</p>
        @elseif (isset($weather))
            <h2>Informações do Clima para {{ $weather->city }}</h2>
            <p>Latitude: {{ $weather->lat ?? 'Indisponível' }}</p>
            <p>Longitude: {{ $weather->lon ?? 'Indisponível' }}</p>
            <p>Temperatura: {{ $weather->temperature }}°C</p>
            <p>Temperatura Mínima: {{ $weather->temperature_min }}°C</p>
            <p>Temperatura Máxima: {{ $weather->temperature_max }}°C</p>
            <p>Humidade: {{ $weather->humidity }}%</p>
            <p>Velocidade do Vento: {{ $weather->wind_speed }}Km/h</p>
            <p>Condição Climática: {{ $weather->weather_condition }}</p>
        @endif
    </div>
    <div class="navigation">
        <a href="{{ url('/list-weather') }}">
            <button>Ver Registros Climáticos</button>
        </a>
    </div>
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('loading').style.display = 'block';
        });
    </script>
</body>
</html>
