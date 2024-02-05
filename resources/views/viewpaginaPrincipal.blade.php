<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Pagina Principal</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 5rem;">
        <div class="container-fluid"> 
            <img class="logoNav" src="./SRC/images/logogalago.png"/>
            <div class="logado" >usuario@galago.com.br <br/>sex 23 de Jan 2024 11:40</div>
        </div>
    </nav> 
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <div class="card" style="width: 18rem; margin:1rem;">
            <img src="C:\Users\flags\Desktop\estudo\ProjetoCRMGalago\SRC\images\AgendaSVG.SVG" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">AGENDA</h5>
              <p class="card-text">Registre e consulte aqui demonstrações e retornos.</p>
              <a href="#" class="btn btn-primary btn-block">Agendamentos</a>
            </div>
        </div>
        <div class="card" style="width: 18rem; margin:1rem;">
            <img src="C:\Users\flags\Desktop\estudo\ProjetoCRMGalago\SRC\images\AtendimentoSVG.SVG" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">ATENDIMENTO</h5>
              <p class="card-text">Registre e consulte aqui os atendimentos.</p>
              <a href="#" class="btn btn-primary">Atendimentos</a>
            </div>
        </div>
        <div class="card" style="width: 18rem; margin:1rem;">
            <img src="C:\Users\flags\Desktop\estudo\ProjetoCRMGalago\SRC\images\TreinamentoSVG.SVG" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">TREINAEMNTO</h5>
              <p class="card-text">Registre e consulte aqui os treinamentos.</p>
              <a href="#" class="btn btn-primary">Treinamentos</a>
            </div>
        </div>
    </div>
    <div>
        <?php
            date_default_timezone_set('America/Sao_Paulo');

            // Obtém a data e hora atual
            $date = new DateTime();
            $date_str = $date->format('Y-m-d H:i');

            // Configura o locale para português do Brasil
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

            // Formata a data e hora conforme o formato desejado em português
            $formatted_date = strftime('%a %d de %b  %Y %H:%M', strtotime($date_str));

            echo $formatted_date;
        ?>
        
    </div>
   
</body>
</html>