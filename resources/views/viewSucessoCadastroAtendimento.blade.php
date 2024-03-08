<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Agenda</title>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"> 
            <img class="logoNav" src="images/logogalago.png"/>
            <div class="logado" >
                usuario@galago.com.br<br/>
                <p id="horaAtual">{{$DATA;}}</p>
            </div>
        </div>
    </nav> 
    <div class="container-fluid" style="display: flex; justify-content: center; margin: 1rem 0rem 1rem 0rem;">
        <button type="button" class="btn btn-secondary" id="btMenu"  data-bs-toggle="modal" data-bs-target="#NovaAgenda">Novo Atendimento</button>
        <a type="button" class="btn btn-secondary" id="btMenu" onclick='href="/PaginaPrincipal"'>Pagina Principal</a>
        <button type="button" class="btn btn-secondary" id="btMenu" data-bs-toggle="modal" data-bs-target="#Filtro">Filtro</button>
    </div>
    <div id="progress-container">
        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div id="progress-bar" class="progress-bar" style="width: 0%">0%</div>
        </div>
        <div id="success-message" style="display: none; justify-content:center; text-align: center;" class="mt-3 alert alert-success" role="alert" >
            <h2>Gravado com Sucesso!</h2>
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
                    window.location.href = "/Atendimentos";
                }, 1000); 
            }
        };

        updateProgress();
    </script>
</body>
</html>
