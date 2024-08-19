<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comandos</title>
</head>
<body>
    <form action="{{route('deploy')}}" method="POST">
        @csrf
        <input type="text" name="senha">
        <input type="text" name="comando">

        <button type="submit">Enviar</button>
    </form>

</body>
</html>
