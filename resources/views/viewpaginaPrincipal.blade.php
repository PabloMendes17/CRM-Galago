<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Pagina Principal</title>
    
</head>
<body>
<h1>Ola! {{$user}}</h1>
    <a href='/vitrine'>Clique</a>
    <a href='/info'>Informações</a><br><br>
    <a href='/cadastrar'>Cadastrar Produtos</a>

</body>
</html>