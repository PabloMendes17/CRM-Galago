<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <form method=POST action="?">
        Descrição:<input type="TEXT" name=prodDesc value='@if(isset($request->prodDesc)){{$request->prodDesc}} @endif'><br>
        Valor:<input type="TEXT" name=prodVal><br>
        <input type="submit" value='cadastrar'>
    </form>
    
</body>
</html>