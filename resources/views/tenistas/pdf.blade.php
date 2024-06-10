<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha del tenista</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div>
    <h1 style="text-align: center">FICHA DEL TENISTA</h1>
</div>
<table class="table">
    <tr>
        <td>
            <p><b>Nombre: </b>{{ $tenista->nombre }}</p>
            <p><b>Pais: </b>{{ $tenista->pais }}</p>
            <p><b>Fecha de nacimiento: </b>{{ $tenista->fecha_nacimiento }}</p>
            <p><b>Edad: </b>{{ $tenista->edad }}</p>
            <p><b>Altura: </b>{{ $tenista->altura }}cm</p>
            <p><b>Peso: </b>{{ $tenista->peso }}kg</p>
            <p><b>Fecha de inicio profesional: </b>{{ $tenista->inicio_profesional }}</p>
            <p><b>Entrenador: </b>{{ $tenista->entrenador }}</p>
            <p><b>Mano buena: </b>{{ $tenista->mano_buena }}</p>
            <p><b>Reves: </b>{{ $tenista->reves }}</p>
            <p><b>Puntos: </b>{{ $tenista->puntos }}</p>
            <p><b>Price money: </b>{{ $tenista->price_money }}</p>
        </td>
        <td>
            <img src="{{ $tenista->imagen_url }}" width="200px" height="200px" style="margin: 20px">
            <p><b>Ranking: </b>{{ $tenista->ranking }}</p>
            <p><b>Best ranking: </b>{{ $tenista->best_ranking }}</p>
            <p><b>Victorias: </b>{{ $tenista->victorias }}</p>
            <p><b>Derrotas: </b>{{ $tenista->derrotas }}</p>
            <p><b>Win/Lose: </b>{{ $tenista->win_lose }}</p>
        </td>
    </tr>
</table>
<div style="border-top: 2px solid black; padding-top: 20px; margin-top: 20px">
    <h4>Torneos activos:</h4>
    @if(!$tenista->torneos->isEmpty())
        @foreach($tenista->torneos as $torneo)
            <p>- {{ $torneo->nombre }}</p>
        @endforeach
    @else
        <p class='lead'><em>No esta en ningun torneo.</em></p>
    @endif
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>
</html><?php
