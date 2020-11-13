<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Contraseña para ingresar a la plataforma JSMT-Admin</title>
</head>
<body>
    <p>Hola! {{ucfirst($user->user_name)}} {{ucfirst($user->user_surname)}} Bienvenido, para entrar a nuestra plataforma debes de utilizar tu numero de identificación y esta contraseña, dentro de nuestra plataforma podras hacer el cambio de contraseña.</p>
    <ul>
        <li>Contraseña:  {{$password}}</li>
    </ul>
</body>
</html>