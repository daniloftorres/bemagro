<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            text-align: center;
        }
        .container {
            margin: 20px auto;
            width: 300px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: left;
        }
        h1 {
            color: #d9534f; /* Cor vermelha para destacar o erro */
        }
        .button-link {
            width: 92%;
            padding: 10px;
            margin-top: 20px;
            background-color: #000;
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
            cursor: pointer;
        }
        .button-link:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ __('messages.error_occurred') }}</h1>
        <p>{{ $error }}</p>
        <p>{{ __('messages.error_status') }} {{ $status }}</p>
        <a class="button-link" href="{{ url('/') }}">{{ __('messages.back_to_home') }}</a>
    </div>
</body>
</html>
