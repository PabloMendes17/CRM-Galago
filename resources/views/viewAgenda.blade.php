<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Agenda</title>
    
</head>
<body>
    <?php
        date_default_timezone_set('America/Sao_Paulo');
        // Obtém a data e hora atual
        $date = new DateTime();
        $date_str = $date->format('Y-m-d H:i');
        // Configura o locale para português do Brasil
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        // Formata a data e hora conforme o formato desejado em português
        $formatted_date = strftime('%a %d de %b %Y %H:%M', strtotime($date_str));
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"> 
            <img class="logoNav" src="images/logogalago.png"/>
            <div class="logado" >
                usuario@galago.com.br<br/>
                {{$formatted_date;}}
            </div>
        </div>
    </nav> 
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <a type="button" class="btn btn-secondary" id="btMenu" >Novo Agendamento</a>
        <a type="button" class="btn btn-secondary" id="btMenu" onclick='href="/"'>Pagina Principal</a>
        <a type="button" class="btn btn-secondary" id="btMenu">Filtro</a>
    </div>
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">CODIGO</th>
                <th scope="col">CONTATO</th>
                <th scope="col">ASSUNTO</th>
                <th scope="col">TIPO</th>
                <th scope="col">HISTORICO</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agenda as $agenda)
                    <tr>
                        <th scope="row">{{$agenda->CODIGO}}</th>
                        <td>{{$agenda->CONTATO}}</td>
                        <td>{{$agenda->ASSUNTO}}</td>
                        <td>{{$agenda->TIPO}}</td>
                        <td>{{$agenda->HISTORICO}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    

</body>
</html>