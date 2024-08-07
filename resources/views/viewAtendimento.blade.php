<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Atendimento</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    <div class="container-fluid" style="display: flex; justify-content: center; margin: 1rem 0rem 1rem 0rem;">
        <a type="button" class="btn btn-secondary" id="btMenu" data-bs-toggle="modal" data-bs-target="#NovoAtendimento">Novo Atendimento</a>
        <a type="button" class="btn btn-secondary" id="btMenu" onclick='href="/PaginaPrincipal"'>Pagina Principal</a>
        <a type="button" class="btn btn-secondary" id="btMenu" data-bs-toggle="modal" data-bs-target="#Filtro">Filtro</a>
    </div>
    <div class="container-fluid"  id="ResultadoBusca">
        <table class="table table-striped table-hover">
            <thead >
                <tr>
                <th scope="col">CODIGO</th>
                <th scope="col">CONTATO</th>
                <th scope="col">ASSUNTO</th>
                <th scope="col">TELEFONE</th>
                <th scope="col">TIPO</th>
                <th scope="col">DATA ATENDIMENTO</th>
                <th scope="col">HORA ATENDIMENTO</th>
                <th scope="col">RESPONSÁVEL</th>
                <th scope="col">SITUAÇÃO</th>
                <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody >
                @forelse($atendimento as $atendimentos)
                    <tr>
                        <th scope="row" class='codigo'>{{$atendimentos->CODIGO}}</th>
                        <td>{{$atendimentos->CONTATO}}</td>
                        <td>{{$atendimentos->ASSUNTO}}</td>
                        <td>{{$atendimentos->TELEFONE1}}</td>
                        <td>{{$atendimentos->TIPO}}</td>
                        <td class='DATA_AGENDA'>{{\Carbon\Carbon::parse($atendimentos->DATA_AGENDA)->format('d/m/Y')}}</td>
                        <td class="HORA_AGENDA"><b>{{ $atendimentos->HORA_AGENDA }}</b></td>
                        <td><b>{{$atendimentos->OPERADOR}}<b></td>
                        <td class="SITUACAO"><b>{{ $atendimentos->SITUACAO }}</b></td>
                        <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Opções">
                            <button type="button" class="btn btn-outline-warning" id="updateSituacao" data-bs-toggle="modal" data-bs-target="#NovaSituacao" data-codigo="{{$atendimentos->CODIGO}}">
                                <img src="/images/updateSVG.png" class="iconOption" alt="...">
                            </button>
                            <button type="button" class="btn btn-outline-info" id="viewDetalhes">
                                <img src="/images/viewSVG.png" class="iconOption" alt="...">
                            </button>
                        </div>
                        </td>  

                    </tr>
                @empty
                    <td></td>   
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="RetornoCadastro"> Nenhum Registro Localizado</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @endforelse
            </tbody>
        </table>
    </div>    
    <div class="modal fade" id="Filtro" tabindex="-1" aria-labelledby="FiltrolLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="FiltroLabel">Filtros</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btFechaFiltro1"></button>
                </div>
                <div class="modal-body container-fluid ">
                    <form class="row g-3" method=POST action="/Atendimentos">
                        <div class=" col-3 ">
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                <input type="number" class="form-control" id="inputCodCliente" placeholder="Cod Cliente" aria-label="Recipient's username" aria-describedby="" name="inputCodCliente" maxLength="6">
                                    <label for="floatingCod">Cod Cliente</label>
                                </div>
                                <button class="btn btn-outline-secondary" type="button" id="btBuscaFiltro" data-bs-target="#BuscaClienteFiltro" data-bs-toggle="modal">Busca</button>
                            </div>
                        </div>    
                        <div class="col-3">
                            <div  class="form-floating mb-3">
                                <input type="date" class="form-control" id="DtInicial" name="DtInicial" >
                                <label for="floatingDtInicial">Data Inicial</label>  
                            </div>
                        </div>
                        <div class="col-3">
                            <div  class="form-floating mb-3">
                                <input type="date" class="form-control" id="DtFinal" name="DtFinal">
                                <label for="floatingDtFinal">Data Final</label>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btFechaFiltro2">Fechar e Não Filtrar</button>
                            <input type="submit" class="btn btn-primary" id="btAplicaFiltro2" onclick="href='/Atendimentos'" value='Aplicar Filtro'>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
    <div class="modal fade" id="BuscaClienteFiltro" aria-hidden="true" aria-labelledby="BuscaClienteFiltro" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ClienteFiltro">Busca de Cliente</h1>
                    <button type="button" class="btn-close" data-bs-target="#Filtro" data-bs-toggle="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body " id="BuscaID">
                    <form name="cadastro" method="post" action="#">
                        <b id="cnpj_cpf">CNPJ/CPF:</b><b id="nome_razao">Nome/Razao:</b>
                        <input type='checkbox' id='ativosmyInput' name='ativosmyInput' checked>
                        <label for="ativos">Ativos</label><br>
                        <input id="myInput" maxlength="18" required name="myInput">
                        <input id="cnpj" style="display: none">
                        <input id="cpf" style="display: none">
                        <input id="razaoFiltro" maxlength="60" required name="razaoFiltro">
                        <button type='button' class="btn btn-secondary btn-sm" id="btCliIdFiltroAtendimento">Busca</button>
                    </form><br>
                    <div id="buscaFiltro">
                        <table class="table table-striped table-hover" id="ClientesParaFiltro">
                            <tbody>
                                @forelse($clientes as $cliente)
                                    <tr class="listaCliFiltrado">
                                        <th scope="row" class="CodCliente" >{{$cliente->codigo}}</th>
                                        <td class="NomeCliente">{{$cliente->nome}}</td>
                                        @if(isset($cliente->cnpj))<td>{{$cliente->cnpj}}</td>@endif
                                        @if(isset($cliente->cpf))<td>{{$cliente->cpf}}</td>@endif
                                    </tr>
                                @empty
                                    <td id="RetornoCadastro"> Nenhum Registro Localizado</td>
                                @endforelse
                            </tbody>
                        </table> 
                        <table class="table table-striped table-hover" id="ClientesJaFiltrado">
                        <!-- Recebe o cliente filtrado -->
                        </table>  
                    </div>    
               </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="NovoAtendimento" tabindex="-1" aria-labelledby="NovoAtendimentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LabelRegistro">Novo Atendimento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btFechaAtendimento1"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="FormInsert" method=POST action="/Atendimento">
                        <div class=" col-2 ">
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="inputCodClienteAT" name="inputCodClienteAT" placeholder="Cod Cliente" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <label for="inputCodClienteAT">Cod Cliente</label>
                                </div>
                                <button class="btn btn-outline-secondary" type="button" id="btBuscaAtedimento" data-bs-target="#BuscaClienteAtendimento" data-bs-toggle="modal">Busca</button>
                            </div>
                        </div>
                        <div class=" col-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="inputNomeClienteAT" name="inputNomeClienteAT" placeholder="Nome/Razão Social" disabled>
                                <label for="floatingName">Nome/Razão Social</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="Operador" name="OPERADOR" value="{{Auth::user()->usuario_PARAMetro}}" disabled>
                                <label for="floatingOp">Operador</label>  
                            </div>
                        </div>
                        <div class="col-6">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingContato" name="CONTATO" required>
                                <label for="floatingContato">Contato</label>  
                            </div>
                        </div>
                        <div class="col-6">
                            <div  class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="floatingAssunto" name="ASSUNTO" required>
                                    <option selected disabled>Selecione</option>
                                    @foreach($tags as $tag)
                                    <option value="{{$tag->TAG}}">{{$tag->TAG}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingAssunto">Assunto</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="date" class="form-control" id="floatingDtRegistro" name="DATA_GRAVACAO" required>
                                <label for="floatingDtRegistro">Data Registro</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="date" class="form-control" id="floatingDtAgenda" name="DATA_AGENDA" required  max="{{$dtLimite}}">
                                <label for="floatingDtAgenda">Data Agenda</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="time" class="form-control" id="floatingHrAgenda" name="HORA_AGENDA" required >
                                <label for="floatingHrAgenda">Hora Agenda</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="floatingSituacao" name="SITUACAO" required >
                                <option selected disabled>Selecione</option>
                                @foreach($situacoes as $situacao)
                                <option value="{{$situacao->DESCRICAO}}">{{$situacao->DESCRICAO}}</option>
                                @endforeach
                                </select>
                                <label for="floatingSituacao">Situacao</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="Tipo" name="TIPO"value="ATENDIMENTO" disabled d>
                                <label for="floatingTipo">Tipo</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="Telefone" name="TELEFONE1" required>
                                <input id="movel" style="display: none">
                                <input id="fixo" style="display: none">
                                <label for="Telefone">Telefone</label>  
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Detalhes do Registro" id="floatingDetalhes" name="HISTORICO" style="height: 150px"></textarea>
                            <label for="floatingDetalhes">Detalhes</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btFechaAtendimento2">Fechar e Não Salvar</button>
                            <input type="submit" class="btn btn-primary" id="btSalvaAtendimento"  value='Salvar Atendimento'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="BuscaClienteAtendimento" aria-hidden="true" aria-labelledby="BuscaClienteAtendimento" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ClienteAtendimento">Busca de Cliente</h1>
                    <button type="button" class="btn-close" data-bs-target="#NovoAtendimento" data-bs-toggle="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body " id="BuscaID">
                    <form name="cadastro" method="post" action="#">
                        <b id="cnpj_cpf">CNPJ/CPF:</b><b id="nome_razao">Nome/Razao:</b>
                        <input type='checkbox' id='ativosAT' name='ativosAT' checked>
                        <label for="ativos">Ativos</label><br>
                        <input id="inputCliAtendimento" maxlength="18" required name="inputCliAtendimento">
                        <input id="cnpj" style="display: none">
                        <input id="cpf" style="display: none">
                        <input id="razaoAT" maxlength="60" required name="razaoAT">
                        <button type='button' class="btn btn-secondary btn-sm" id="btbuscaPorID_AT">Busca</button>
                    </form><br>
                    <div id="buscaFiltro">
                        <table class="table table-striped table-hover" id="ClientesParaAtendimento">
                            <tbody>
                                @forelse($clientes as $cliente)
                                    <tr class="listaCliFiltrado">
                                        <th scope="row" class="CodClienteAT" >{{$cliente->codigo}}</th>
                                        <td class="NomeClienteAT">{{$cliente->nome}}</td>
                                        @if(isset($cliente->cnpj))<td>{{$cliente->cnpj}}</td>@endif
                                        @if(isset($cliente->cpf))<td>{{$cliente->cpf}}</td>@endif
                                    </tr>
                                @empty
                                    <td id="RetornoCadastro"> Nenhum Registro Localizado</td>
                                @endforelse
                            </tbody>
                        </table> 
                        <table class="table table-striped table-hover" id="ClientesNoAtendimento">
                        <!-- Recebe o cliente filtrado -->
                        </table>
                    </div>      
               </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DetalheRegistro" tabindex="-1" aria-labelledby="DetalheRegistro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LabelDetalhes">Detalhes do Atendimento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btFechaDetalheRegistro"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">Código do Cliente:</dt>
                        <dd class="col-sm-9"><span id="RegistroCodCli"></span></dd>
                        <dt class="col-sm-3">Nome/Razão:</dt>
                        <dd class="col-sm-9"><span id="RegistroNameCli"></span></dd>
                        <dt class="col-sm-3">CPF/CNPJ:</dt>
                        <dd class="col-sm-9"><span id="RegistroDocCli"></span></dd>
                        <br><br>
                        <dt class="col-sm-3">Atendimento Nº:</dt>
                        <dd class="col-sm-9"><span id="codigoRegistro"></span></dd>
                        <dt class="col-sm-3">Detalhes:</dt>
                        <dd class="col-sm-9"><span id="detalhesRegistro"></span></dd><br>
                    </dl>
                </div>
            </div>
        </div>
    </div> 
    <div class="modal fade" id="NovaSituacao" tabindex="-1" aria-labelledby="NovaSituacao" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LabelRegistro">Nova Situacao </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btFechaNovaSituacao2"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="FormInsert"> 
                        <div class="col-12">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="upDateAssunto" name="ASSUNTO" required disabled>
                                <label for="ASSUNTO">Assunto</label>  
                            </div>
                            <div  class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" id="situacaoSelecionada" name="SITUACAO" required>
                                    <option selected disabled>Selecione</option>
                                    @foreach($situacoes as $situacao)
                                    <option value="{{$situacao->DESCRICAO}}">{{$situacao->DESCRICAO}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSituacao">Situacao</label>  
                            </div>
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="upDateTelefone" name="TELEFONE1" required>
                                <input id="movel" style="display: none">
                                <input id="fixo" style="display: none">
                                <label for="Telefone">Telefone</label>  
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Detalhes do Registro" id="upDateDetalhes" name="HISTORICO" style="height: 150px">
                                </textarea>
                                <label for="floatingDetalhes">Detalhes</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btFechaNovaSituacao2">Fechar e Não Salvar</button>
                                <input type="button" class="btn btn-primary" id="btSalvaSituacao"  value='Salvar Situacao'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</body>
</html>