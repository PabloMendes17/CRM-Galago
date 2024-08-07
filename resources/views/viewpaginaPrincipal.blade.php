<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Pagina Principal</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    
</head>
<body>
    @if (isset($error))
        <div class="modal" id="Error"  tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atenção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{$error}}</p>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 1rem;">
        <div id="nav" class="container-fluid"> 
            <img class="logoNav" src="images/logogalago.png"/>
            <div class="logado" >
                <br>{{Auth::user()->EMAIL}}
                <p id="horaAtual">{{$DATA;}}</p>
            </div>
        </div>
        <div class="btn-group btn-group-sm" role="group" aria-label="Logout">
            <a type="button" class="btn btn-outline-warning" id="logout" href="/logout" >
                <img src="/images/logoutSVG.png" class="logout" alt="...">
            </a>
        </div>   
    </nav> 
    <div id="cards" class="container-fluid">
        <div class="card" id="card">
            <img src="images/AgendaSVG2.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">AGENDA</h5>
              <p class="card-text">Registre e consulte aqui demonstrações e retornos.</p>
              <a href="/Agendamentos" class="btn btn-primary btn-block">Agendamentos</a>
            </div>
        </div>
        <div class="card" id="card">
            <img src="/images/AtendimentoSVG.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">ATENDIMENTO</h5>
              <p class="card-text">Registre e consulte aqui os atendimentos.</p>
              <a href="/Atendimentos" class="btn btn-primary">Atendimentos</a>
            </div>
        </div> 
        <div class="card" id="card">
            <img src="/images/installSVG.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">INSTALADORES</h5>
              <p class="card-text">Acesse e baixe o setup's necessários.</p>
              <a href="/Instaladores" class="btn btn-primary">Instaladores</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</body>
</html>