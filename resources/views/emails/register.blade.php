<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de registro</title>
</head>
<body>
<div>
    <h2>Confirmación de registro en ATP Tour</h2>
    <p>Estimado/a {{ $user->nombre }},</p>

    <p>¡Bienvenido/a a ATP Tour Estamos encantados/as de tenerte como parte de nuestra comunidad. Tu registro ha sido exitoso y ahora formas parte de nuestra plataforma.</p>

    <p>A continuación, encontrarás tus datos de inicio de sesión:</p>
    <ul>
        <li><strong>Email: </strong>{{ $user->email }}</li>
    </ul>

    <p>Accede a nuestra plataforma <a href="{{ route('tenistas.index') }}">aquí</a> para comenzar a explorar todas las funciones y servicios que ofrecemos.</p>

    <p>Gracias por unirte a ATP Tour. Estamos emocionados/as de trabajar contigo.</p>

    <p>Atentamente,<br>El equipo de ATP Tour<br></p>
</div>
</body>
