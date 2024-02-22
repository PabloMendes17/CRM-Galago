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
                {{$formatted_date}}
            </div>
        </div>
    </nav> 
    <div class="container-fluid" style="display: flex; justify-content: center; margin: 1rem 0rem 1rem 0rem;">
        <button type="button" class="btn btn-secondary" id="btMenu"  data-bs-toggle="modal" data-bs-target="#NovaAgenda">Novo Agendamento</button>
        <a type="button" class="btn btn-secondary" id="btMenu" onclick='href="/"'>Pagina Principal</a>
        <button type="button" class="btn btn-secondary" id="btMenu" data-bs-toggle="modal" data-bs-target="#Filtro">Filtro</button>
    </div>
    <div id="progress-container">
        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div id="progress-bar" class="progress-bar" style="width: 0%">0%</div>
        </div>
        <div id="success-message" style="display: none; justify-content:center;" class="mt-3 alert alert-success" role="alert" >
            <h2>Gravado com sucesso!</h2>
        </div>
    </div>
    <script>

        let progress = 0;

        const updateProgress = () => {
 
            progress += 1;
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('progress-bar').innerHTML = progress + '%';

            if (progress < 100) {

                setTimeout(updateProgress, 0.06); 
            } else {
                document.getElementById('success-message').style.display = 'block';

                setTimeout(() => {
                    window.location.href = "/Agendamentos";
                }, 1000); 
            }
        };

        updateProgress();
    </script>
</body>
</html>
