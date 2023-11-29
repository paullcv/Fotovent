<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitacion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .event-details {
            text-align: left;
            margin-top: 20px;
        }

        .event-details p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invitacion</h1>
        <p>Para: {{$event->nombre}}</p>

        <div class="event-details">
            <p><strong>Descripción:</strong> {{$event->descripcion}}</p>
            <p><strong>Ubicación:</strong> {{$event->ubicacion}}</p>
            <p><strong>Fecha:</strong> {{$event->fecha}}</p>
            <p><strong>Hora:</strong> {{$event->hora}}</p>
        </div>
    </div>
</body>
</html>
