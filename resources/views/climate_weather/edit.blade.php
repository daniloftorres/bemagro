<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informações do Clima</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            text-align: center;
        }
        .form-container {
            margin: 20px auto;
            width: 300px;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: left;
        }
        input[type="text"], input[type="number"], button, .button-link {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover, .button-link:hover {
            opacity: 0.85;
        }
        .button-link {
            background-color: #000;
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Editar Informações do Clima ({{ $weather->id }})</h1>
        <form method="post" action="/edit-weather/{{ $weather->id }}">
        @csrf
        <input type="text" name="city" value="{{ $weather->city }}" placeholder="City" required>
        <input type="number" step="0.01" name="temperature" value="{{ $weather->temperature }}" placeholder="Temperature" required>
        <input type="text" name="weather_condition" value="{{ $weather->weather_condition }}" placeholder="Weather Condition" required>
        <input type="number" step="0.0000001" name="lat" value="{{ $weather->lat }}" placeholder="Latitude" required>
        <input type="number" step="0.0000001" name="lon" value="{{ $weather->lon }}" placeholder="Longitude" required>
        <input type="number" step="0.01" name="wind_speed" value="{{ $weather->wind_speed }}" placeholder="Wind Speed" required>
        <input type="number" step="0.01" name="humidity" value="{{ $weather->humidity }}" placeholder="Humidity" required>
        <input type="number" step="0.01" name="temperature_min" value="{{ $weather->temperature_min }}" placeholder="Minimum Temperature" required>
        <input type="number" step="0.01" name="temperature_max" value="{{ $weather->temperature_max }}" placeholder="Maximum Temperature" required>
        <button type="submit">Update Weather</button>
    </form>
        <a class="button-link" href="/list-weather">Voltar</a>
    </div>
</body>
</html>
