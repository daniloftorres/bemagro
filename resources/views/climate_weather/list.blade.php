<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem do Clima</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
            width: fit-content;
            margin: auto;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        li {
            margin-bottom: 10px;
            text-align: left;
        }
        a, button {
            margin-right: 10px;
        }
        form {
            display: inline;
        }
        .button-link {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #000;
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .button-link:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <h1>Lista de Registros Climáticos</h1>
    <ul>
        @foreach ($weatherData as $weather)
        <li>
            ({{ $weather->id }}) | {{ $weather->city }}: {{ $weather->temperature }}°C - 
            <a href="/edit-weather/{{ $weather->id }}">Edit</a>
            <form action="/delete-weather/{{$weather->id}}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Você tem certeza?')">Delete</button>
            </form>
        </li>
        
        @endforeach
        <li><a class="button-link" href="{{ url('/') }}">Voltar</a></li>
    </ul>
    
</body>
</html>
