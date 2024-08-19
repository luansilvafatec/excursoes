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
        <label for="senha">Senha</label>
        <input type="text" name="senha" id="senha">
        <label for="comando">Comando</label>
        <input type="text" name="comando" id="comando">

        <button type="submit">Enviar</button>
    </form>

</body>
</html>
