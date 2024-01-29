<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos</h1>
    <ul>
        @foreach($produtos as $produtos)
        <li>{{$produtos}}</li>
        @endforeach

    </ul>
    <a href='/info'>Informações</a>
</body>
</html>