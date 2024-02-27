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
                usuario@galago.com.br
                <p id="horaAtual">{{$DATA;}}</p>
            </div>
        </div>
    </nav> 
    <div class="container-fluid" style="display: flex; justify-content: center; margin: 1rem 0rem 1rem 0rem;">
        <button type="button" class="btn btn-secondary" id="btMenu"  data-bs-toggle="modal" data-bs-target="#NovaAgenda">Novo Agendamento</button>
        <a type="button" class="btn btn-secondary" id="btMenu" onclick='href="/"'>Pagina Principal</a>
        <button type="button" class="btn btn-secondary" id="btMenu" data-bs-toggle="modal" data-bs-target="#Filtro">Filtro</button>
    </div>
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <table class="table table-striped table-hover">
            <thead >
                <tr>
                <th scope="col">CODIGO</th>
                <th scope="col">CONTATO</th>
                <th scope="col">ASSUNTO</th>
                <th scope="col">TIPO</th>
                <th scope="col">HISTORICO</th>
                </tr>
            </thead>
            <tbody >
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
    <div class="modal fade" id="Filtro" tabindex="-1" aria-labelledby="FiltrolLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="FiltroLabel">Filtros</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btFechaFiltro1"></button>
                </div>
                <div class="modal-body container-fluid ">
                    <form class="row g-3" method=POST action="/Agendamentos">
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
                                <label for="DtInicial">Data Inicial</label>  
                            </div>
                        </div>
                        <div class="col-3">
                            <div  class="form-floating mb-3">
                                <input type="date" class="form-control" id="DtFinal" name="DtFinal" >
                                <label for="DtFinal">Data Final</label>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btFechaFiltro2" >Fechar e Não Filtrar</button>
                            <input type="submit" class="btn btn-primary" id="btAplicaFiltro2" onclick="href='/Agendamentos'" value='Aplicar Filtro'>
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
                        <b id="cnpj_cpf">CNPJ/CPF:</b>
                        <input id="myInput" maxlength="18" required name="myInput">
                        <input id="cnpj" style="display: none">
                        <input id="cpf" style="display: none">
                        <button type='button' id="btbuscaPorID">Busca</button>
                    </form><br>
                    <table class="table table-striped table-hover" id="ClientesParaFiltro">
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr class="listaCliFiltrado">
                                    <th scope="row" class="CodCliente" >{{$cliente->CODIGO}}</th>
                                    <td class="NomeCliente">{{$cliente->NOME}}</td>
                                    <td>{{$cliente->CNPJ}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <table class="table table-striped table-hover" id="ClientesJaFiltrado">
                    <!-- Recebe o cliente filtrado -->
                    </table>  
               </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="NovaAgenda" tabindex="-1" aria-labelledby="NovaAgendaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AgendaLabel">Nova Agenda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btFechaAgenda1"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method=POST action="/Agendamento"> 
                        <div class=" col-2 ">
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="inputCodClienteAG" name="inputCodClienteAG" placeholder="Cod Cliente" aria-label="Recipient's username" aria-describedby="button-addon2" maxLength="6">
                                    <label for="inputCodClienteAG">Cod Cliente</label>
                                </div>
                                <button class="btn btn-outline-secondary" type="button" id="btBuscaAgenda" data-bs-target="#BuscaClienteAgenda" data-bs-toggle="modal">Busca</button>

                            </div>
                        </div>
                        <div class=" col-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="inputNomeClienteAG" name="inputNomeClienteAG" placeholder="Nome/Razão Social" disabled>
                                <label for="inputNomeClienteAG">Nome/Razão Social</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="Operador" name="OPERADOR" value="SUPORTE" disabled>
                                <label for="floatingOp">Operador</label>  
                            </div>
                        </div>
                        <div class="col-6">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingContato" name="CONTATO" required>
                                <label for="floatingContato">Cotato</label>  
                            </div>
                        </div>
                        <div class="col-6">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingAssunto" name="ASSUNTO" required>
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
                                <input type="date" class="form-control" id="floatingDtAgenda" name="DATA_AGENDA" required>
                                <label for="floatingDtAgenda">Data Agenda</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="time" class="form-control" id="floatingHrAgenda" name="HORA_AGENDA" required>
                                <label for="floatingHrAgenda">Hora Agenda</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="floatingSituacao" name="SITUACAO" required>
                                <option selected>Selecione</option>
                                <option value="PENDENTE">PENDENTE</option>
                                <option value="RESOLVIDO">RESOLVIDO</option>
                                <option value="DIVERSOS">DIVERSOS</option>
                                </select>
                                <label for="floatingSituacao">Situacao</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="Tipo" name="TIPO"value="AGENDAMENTO" disabled >
                                <label for="floatingTipo">Tipo</label>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div  class="form-floating mb-3">
                                <input type="text" class="form-control" id="Telefone" name="TELEFONE1" required>
                                <label for="Telefone">Telefone</label>  
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Detalhes do Registro" id="floatingDetalhes" name="HISTORICO" style="height: 150px"></textarea>
                            <label for="floatingDetalhes">Detalhes</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btFechaAgenda2">Fechar e Não Salvar</button>
                            <input type="submit" class="btn btn-primary" id="btSalvaAgenda"  value='Salvar Agenda'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="BuscaClienteAgenda" aria-hidden="true" aria-labelledby="BuscaClienteAgenda" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ClienteAgenda">Busca de Cliente</h1>
                    <button type="button" class="btn-close" data-bs-target="#NovaAgenda" data-bs-toggle="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body " id="BuscaID">
                    <form name="cadastro" method="post" action="#">
                        <b id="cnpj_cpf">CNPJ/CPF:</b>
                        <input id="inputCliAgenda" maxlength="18" required name="inputCliAgenda">
                        <input id="cnpj" style="display: none">
                        <input id="cpf" style="display: none">
                        <button type='button' id="btbuscaPorID_AG">Busca</button>
                    </form><br>
                    <table class="table table-striped table-hover" id="ClientesParaAgenda">
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr class="listaCliFiltrado">
                                    <th scope="row" class="CodClienteAG" >{{$cliente->CODIGO}}</th>
                                    <td class="NomeClienteAG">{{$cliente->NOME}}</td>
                                    <td>{{$cliente->CNPJ}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <table class="table table-striped table-hover" id="ClientesNaAgenda">
                    <!-- Recebe o cliente filtrado -->
                    </table>  
               </div>
            </div>
        </div>
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>


</body>
</html>