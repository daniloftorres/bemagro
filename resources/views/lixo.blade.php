<!DOCTYPE html>
<html>
<head>
    <title>Informações do Clima</title>
</head>
<body>
<h1>Informações do Clima</h1>
    <form action="{{ url('/') }}" method="GET">
        <input type="text" name="city" placeholder="Digite a cidade" required>
        <button type="submit">Buscar Clima</button>
    </form>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (!$weatherStatus)
        <p>{{$weatherMsg}}</p>
    @else
        <h2>Informações do Clima para {{ $weather->city }}</h2>
        <p>Latitude: {{ $weather->lat ?? 'Indisponível' }}</p>
        <p>Longitude: {{ $weather->lon ?? 'Indisponível' }}</p>
        <p>Temperatura: {{ $weather->temperature }}°C</p>
        <p>Temperatura Minima: {{ $weather->temperature_min }}°C</p>
        <p>Temperatura Maxima: {{ $weather->temperature_max }}°C</p>
        <p>Humidade: {{ $weather->humidity }}%</p>
        <p>Velocidade do Vento: {{ $weather->wind_speed }}Km/h</p>
        <p>Condição Climática: {{ $weather->weather_condition }}</p>
    @endif
    
</body>
</html>