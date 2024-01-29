<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
</head>
<body>
    <h1>Informações</h1>
    <p>Oque {{$user}}<p>
    <ul>
        @foreach($produtos as $produtos)
        <li>{{$produtos}}</li>
        @endforeach
    </ul>
    
</body>
</html>