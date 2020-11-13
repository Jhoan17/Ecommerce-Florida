<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Contraseña nueva</title>
</head>
<body>
    <p>Hola! {{ucfirst($user->user_name)}} {{ucfirst($user->user_surname)}} Se ha reportado un nuevo caso de recuperacion de cuenta .</p>
    <ul>
        <li>Contraseña nueva:  {{$passwordNew}}</li>
    </ul>
</body>
</html>