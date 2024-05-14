import './bootstrap';



function atualizarHora() {
    var agora = new Date();
    var horaFormatada = agora.toLocaleString('pt-BR', {
        weekday: 'short', 
        day: '2-digit',  
        month: 'short', 
        year: 'numeric', 
        hour: '2-digit',  
        minute: '2-digit'
    });
    horaFormatada = horaFormatada.replace(/\b(\w+)\./g, '$1');
    document.getElementById('horaAtual').innerText = horaFormatada;
}
atualizarHora();
setInterval(atualizarHora, 1000);
$(document).ready(function() {
    $('#Error').modal('show');
});
setInterval(function() {//Função para Destacar status e hora na lista
    var linhasBusca = document.querySelectorAll('tbody tr'); // armazena tada a tabela na variavel

    linhasBusca.forEach(function(linha) {
        
        var horaAgendaElemento = linha.querySelector('.HORA_AGENDA');
        var dataAgendaElemento = linha.querySelector('.DATA_AGENDA');
        var situacaoElemento = linha.querySelector('.SITUACAO');
    
        if (horaAgendaElemento && dataAgendaElemento && situacaoElemento) {
        var horaAgendaRaw = horaAgendaElemento.textContent.trim();
        var dataAgendaRaw = dataAgendaElemento.textContent.trim();
        var situacao = situacaoElemento.textContent.trim();

        var horaAgendaComponents = horaAgendaRaw.split(':');
        var dataAgendaComponents = dataAgendaRaw.split('/');

        var horaAgenda = new Date();// cria um objeto hora para comparar
        horaAgenda.setHours(parseInt(horaAgendaComponents[0], 10));
        horaAgenda.setMinutes(parseInt(horaAgendaComponents[1], 10));

        var dataAgenda = new Date();// cria um objeto Data para comparar
        dataAgenda.setFullYear(parseInt(dataAgendaComponents[2], 10));
        dataAgenda.setMonth(parseInt(dataAgendaComponents[1], 10) - 1);
        dataAgenda.setDate(parseInt(dataAgendaComponents[0], 10));

        var dataAtual = new Date();
        var horaAtual = dataAtual.getTime();

        if(dataAgenda >= dataAtual){//troca a classe php para as linhas
            if( horaAgenda.getTime() < horaAtual && (situacao === 'PENDENTE' || situacao === 'AGUARDANDO DESENVOLVIMENTO' || situacao === 'AGUARDANDO SUPERVISAO' || situacao === 'AGUARDANDO FINANCEIRO')){
                horaAgendaElemento.classList.add('text-danger');
                situacaoElemento.classList.add('text-danger');
            }else if(horaAgenda.getTime() >= horaAtual && (situacao === 'PENDENTE' || situacao === 'AGUARDANDO DESENVOLVIMENTO' || situacao === 'AGUARDANDO SUPERVISAO' || situacao === 'AGUARDANDO FINANCEIRO')){
                horaAgendaElemento.classList.add('text-primary');
                situacaoElemento.classList.add('text-primary');
            }else if (situacao === 'RESOLVIDO') {
                horaAgendaElemento.classList.add('text-success');
                situacaoElemento.classList.add('text-success');
            } else if (situacao === 'REAGENDADO') {
                horaAgendaElemento.classList.add('text-warning');
                situacaoElemento.classList.add('text-warning');
            }

        }else{
            if(situacao === 'PENDENTE' || situacao === 'AGUARDANDO DESENVOLVIMENTO' || situacao === 'AGUARDANDO SUPERVISAO' || situacao === 'AGUARDANDO FINANCEIRO'){
                horaAgendaElemento.classList.add('text-danger');
                situacaoElemento.classList.add('text-danger');  
            }else if (situacao === 'RESOLVIDO') {
                horaAgendaElemento.classList.add('text-success');
                situacaoElemento.classList.add('text-success');
            } else if (situacao === 'REAGENDADO') {
                horaAgendaElemento.classList.add('text-warning');
                situacaoElemento.classList.add('text-warning');
            }
        }
       
    }});    
}, 1000);

$(document).ready(function() {//Chama a função que exibe detalhes
    $(document).on('click', '#viewDetalhes', function() {
        var CODIGO = $(this).closest('tr').find('.codigo').text();
        viewUser(CODIGO);
    });
});
async function viewUser(CODIGO) {//Exibe os detalhes do registro
    const response = await fetch('/visualizar/' + CODIGO);
    console.log(response);
    const data = await response.json();
    console.log(data);
    const viewModelDetalhe= document.getElementById("DetalheRegistro");
    document.getElementById('RegistroCodCli').innerHTML=data.cliente.codigo;
    document.getElementById('RegistroNameCli').innerHTML=data.cliente.nome;
    if(data.cliente.cnpj===null||data.cliente.cnpj===''){
        document.getElementById('RegistroDocCli').innerHTML=data.cliente.cpf;
    }else{
        document.getElementById('RegistroDocCli').innerHTML=data.cliente.cnpj;
    }
    document.getElementById('codigoRegistro').innerHTML=data.agenda.CODIGO;
    document.getElementById('detalhesRegistro').innerHTML=data.agenda.HISTORICO;
    
    $('#DetalheRegistro').modal('show');

}

var codigoRegistro;
var novaSituacao;
$(document).ready(function() {//Chama a função que exibe detalhes
    
    $(document).on('click', '#updateSituacao', function() {
        codigoRegistro = $(this).data('codigo');

    });

    $(document).on('click', '#btSalvaSituacao', function() {
        novaSituacao=$('#situacaoSelecionada').val();
    
        updateSituacao(codigoRegistro,novaSituacao);
    });
});
async function updateSituacao(CODIGO,SITUACAO) {//Exibe os detalhes do registro
    try {
        const response = await fetch('/updateSituacao/' + CODIGO, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ SITUACAO: SITUACAO })
        });

        if (response.ok) {            

            $('#NovaSituacao').modal('hide');

            await Swal.fire({
                title: "Alterada!",
                text: "Situação atualizada com sucesso!",
                icon: "success"
              });

            location.reload();
            
        } else {
            alert('Falha ao atualizar a situação');
            console.log(CODIGO);
            console.log(SITUACAO);
            // Se desejar lidar com o caso de falha na atualização, você pode fazer aqui
        }
    } catch (error) {
        console.error('Erro ao enviar requisição:', error);
        // Se ocorrer algum erro durante o envio da requisição, ele será capturado aqui
    }
    
}
document.getElementById('FormInsert').addEventListener('submit', function(event) {//Trata o comboList para não ser enviado a opção Selecione
    var situacao = document.getElementById('floatingSituacao').value;
    if (situacao === null || situacao === ""|| situacao==='Selecione') {
        alert('Por favor, selecione uma opção para a situação.');
        event.preventDefault(); 
    }
});


//Funções para viewAgenda
  $(function(){//Func Mascara Input DocFiltro
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#myInput').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');

        if (val.length<=11&&val!=='') {
            $('#cpf').val(val);
            $(this).val($('#cpf').masked());
            $('#cnpj_cpf').text('CPF');
        } else if(val.length>=14){
            $('#cnpj').val(val);
            $(this).val($('#cnpj').masked());
            $('#cnpj_cpf').text('CNPJ');
        }else{
            $('#cpf').val('');
            $('#cnpj').val('');
            $('#cnpj_cpf').text('CNPJ/CPF');
        }
    }).keyup(); // Chama o evento keyup imediatamente para aplicar a máscara inicial
});
$(document).ready(function() {//Valida CPF&CNPJ
    $('#btbuscaPorID').on('click', function() {

        if((document.getElementById('myInput').value).length>0){
           
            if(((document.getElementById('myInput').value).length<14||(document.getElementById('myInput').value).length>18)||((document.getElementById('myInput').value).length>14&&(document.getElementById('myInput').value).length<18)){
                alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
            }else{
                buscaPorID();
            }

        }else if((document.getElementById('razaoFiltro').value).length<3&&(document.getElementById('myInput').value).length<1){
            alert('Nome muito curto, verifique e tente novamente')

        }else{

            buscaPorID();
        }
    });
});
function buscaPorID() { //Filtra Cli por Doc
    //Verifica se a busca é por Doc ou Nome
    if((document.getElementById('myInput').value).length>0){
        var idCli = document.getElementById('myInput').value; 
        var campo='myInput';
    }else{
        var idCli = document.getElementById('razaoFiltro').value; 
        var campo='razaoFiltro';
    }

    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Agendamentos',
        type: 'POST',
        data: { [campo]: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaFiltro').html();
            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaFiltro').hide();

            // Verifica se a tabela está vazia
            if (tabelaHtml.trim() === '') {
                $('#ClientesJaFiltrado').html('<tr><td colspan="5">Nenhum registro localizado</td></tr>');
            } else {
                $('#ClientesJaFiltrado').html(tabelaHtml);
                $('#ClientesJaFiltrado').find('.listaCliFiltrado').on('click', function() {
                    var CodCliente = $(this).find('.CodCliente').text(); // Extrair o código correspondente do item clicado
                    $('#inputCodCliente').val(CodCliente); //Atribui o valor ao compo Cod Cliente
                    $('#Filtro').modal('show');
                    $('#BuscaClienteFiltro').modal('hide');
                });
            }
        },
    });
}
$('#ClientesParaFiltro').find('.listaCliFiltrado').on('click',function() {//Carrega cliente da lista para
    var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
    $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
    $('#Filtro').modal('show');
    $('#BuscaClienteFiltro').modal('hide');
});
$(document).ready(function() {//espera ser digitado algum valor no campo cod cliente da Modal NovaAgenda
    $('#inputCodClienteAG').on('keyup', function() {
        var idCli = $(this).val(); // Obtém o valor do campo inputCodClienteAG
        buscaIdCLi(idCli); // Chama a função buscaPorIdCli com o valor digitado
 
    });
});
function buscaIdCLi(idCli) {//Filtra Cli por Doc Agenda
    //Chama a Rota que processa o filtro

    if(idCli!==null&&idCli!==''){
        $.ajax({
            url: '/Agendamentos',
            type: 'POST',
            data: { inputCliAgenda: idCli },
            success: function(response) {
                //No sucesso traz uma view igual com os dados filtrados
                // Busca na view somente a Tabela em html e armazena na variável
                var tabelaHtml = $(response).find('#ClientesParaAgenda').html();

                //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
                $('#ClientesParaAgenda').hide();
                $('#ClientesNaAgenda').html(tabelaHtml);
                    var CodCliente = $('#ClientesNaAgenda').find('.listaCliFiltrado').find('.CodClienteAG').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteAG').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$('#ClientesNaAgenda').find('.listaCliFiltrado').find('.NomeClienteAG').text(); 
                    $('#inputNomeClienteAG').val(NomeCliente);
                    $('#NovaAgenda').modal('show');
                    $('#BuscaClienteAgenda').modal('hide');
                
            },
        });
    }
}
document.addEventListener('DOMContentLoaded', function () {
    var novaAgendaElement = document.getElementById('NovaAgenda');
    
    if (novaAgendaElement) {
        novaAgendaElement.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const index = Array.from(this.elements).indexOf(document.activeElement) + 3;
                if (this.elements[index]) {
                    this.elements[index].focus();
                }
            }
        });
    }
});
$(function(){//Func Mascara Input DocAgenda
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#inputCliAgenda').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');

        if (val.length<=11) {
            $('#cpf').val(val);
            $(this).val($('#cpf').masked());
            $('#cnpj_cpf').text('CPF');
        } else if(val.length>=14){
            $('#cnpj').val(val);
            $(this).val($('#cnpj').masked());
            $('#cnpj_cpf').text('CNPJ');
        }else{
            $('#cpf').val('');
            $('#cnpj').val('');
            $('#cnpj_cpf').text('CNPJ/CPF');
        }
    }).keyup(); // Chama o evento keyup imediatamente para aplicar a máscara inicial
});
$(document).ready(function() {//Valida CPF&CNPJ Agenda
    $('#btbuscaPorID_AG').on('click', function() {
        if((document.getElementById('inputCliAgenda').value).length>0){
           
            if(((document.getElementById('inputCliAgenda').value).length<14||(document.getElementById('inputCliAgenda').value).length>18)||((document.getElementById('inputCliAgenda').value).length>14&&(document.getElementById('inputCliAgenda').value).length<18)){
                alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
            }else{
                buscaPorIdCLi();
            }

        }else if((document.getElementById('razaoAG').value).length<3&&(document.getElementById('inputCliAgenda').value).length<1){
            alert('Nome muito curto, verifique e tente novamente')

        }else{

            buscaPorIdCLi();
        }
    });
});
function buscaPorIdCLi() {//Filtra Cli por Doc Agenda
    //Verifica se a busca é por Doc ou Nome
    if((document.getElementById('inputCliAgenda').value).length>0){
        var idCli = document.getElementById('inputCliAgenda').value; 
        var campo='inputCliAgenda';
    }else{
        var idCli = document.getElementById('razaoAG').value; 
        var campo='razaoAG';
    }
    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Agendamentos',
        type: 'POST',
        data: { [campo]: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            
            var tabelaHtml = $(response).find('#ClientesParaAgenda').html();
            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaAgenda').hide();

            if(tabelaHtml.trim() === ''){
                $('#ClientesNaAgenda').html('<tr><td colspan="5">Nenhum registro localizado</td></tr>');     
            }else{
                $('#ClientesNaAgenda').html(tabelaHtml);

                $('#ClientesNaAgenda').find('.listaCliFiltrado').on('click',function() {

                    var CodCliente = $(this).find('.CodClienteAG').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteAG').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$(this).find('.NomeClienteAG').text(); 
                    $('#inputNomeClienteAG').val(NomeCliente);
                    $('#NovaAgenda').modal('show');
                    $('#BuscaClienteAgenda').modal('hide');
                });
            }  
        },
    });
}
$('#ClientesParaAgenda').find('.listaCliFiltrado').on('click',function() {//Carrega cliente da lista para
    var CodCliente = $(this).find('.CodClienteAG').text() // Extrair o código correspondente do item clicado
    $('#inputCodClienteAG').val(CodCliente);//Atribui o valor ao compo Cod Cliente
    var NomeCliente=$(this).find('.NomeClienteAG').text(); 
    $('#inputNomeClienteAG').val(NomeCliente);
    $('#NovaAgenda').modal('show');
    $('#BuscaClienteAgenda').modal('hide');
});
$(document).ready(function() {
    // Adiciona um evento de submissão ao formulário
    $('form').submit(function() {
        // Remove o atributo 'disabled' do campo antes do envio
        $('#inputNomeClienteAG').removeAttr('disabled');
        $('#Operador').removeAttr('disabled');
        $('#Tipo').removeAttr('disabled');
    });
});


//Funções para Atendimento
$(document).ready(function() {//Valida CPF&CNPJ
    $('#btCliIdFiltroAtendimento').on('click', function() {
        if((document.getElementById('myInput').value).length>0){
           
            if(((document.getElementById('myInput').value).length<14||(document.getElementById('myInput').value).length>18)||((document.getElementById('myInput').value).length>14&&(document.getElementById('myInput').value).length<18)){
                alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
            }else{
                buscaPorIdAt();
            }

        }else if((document.getElementById('razaoFiltro').value).length<3&&(document.getElementById('myInput').value).length<1){
            alert('Nome muito curto, verifique e tente novamente')

        }else{

            buscaPorIdAt();
        }
    });
});
function buscaPorIdAt() { //Filtra Cli por Doc
    //Verifica se a busca é por Doc ou Nome
    if((document.getElementById('myInput').value).length>0){
        var idCli = document.getElementById('myInput').value; 
        var campo='myInput';
    }else{
        var idCli = document.getElementById('razaoFiltro').value; 
        var campo='razaoFiltro';
    }
    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Atendimentos',
        type: 'POST',
        data: { [campo]: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaFiltro').html();

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaFiltro').hide();

            if(tabelaHtml.trim() === ''){
                $('#ClientesJaFiltrado').html('<tr><td colspan="5">Nenhum registro localizado</td></tr>');
            }else{
                $('#ClientesJaFiltrado').html(tabelaHtml);

                $('#ClientesJaFiltrado').find('.listaCliFiltrado').on('click',function() {
                    var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
                    $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    $('#Filtro').modal('show');
                    $('#BuscaClienteFiltro').modal('hide');
                });
            }
        },
    });
}
$(document).ready(function() {//espera ser digitado algum valor no campo cod cliente da Modal NovaAtendimentop
    $('#inputCodClienteAT').on('keyup', function() {
        var idCli = $(this).val(); // Obtém o valor do campo inputCodClienteAT
        buscaIdCliAt(idCli); // Chama a função buscaIdCliAt com o valor digitado
 
    });
});
function buscaIdCliAt(idCli) {//Filtra Cli por Doc Atendimento
    //Chama a Rota que processa o filtro

    if(idCli!==null&&idCli!==''){
        $.ajax({
            url: '/Atendimentos',
            type: 'POST',
            data: { inputCliAtendimento: idCli },
            success: function(response) {
                //No sucesso traz uma view igual com os dados filtrados
                // Busca na view somente a Tabela em html e armazena na variável
                var tabelaHtml = $(response).find('#ClientesParaAtendimento').html();

                //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
                $('#ClientesParaAtendimento').hide();
                $('#ClientesNoAtendimento').html(tabelaHtml);
    
          
    
                    var CodCliente = $('#ClientesNoAtendimento').find('.listaCliFiltrado').find('.CodClienteAT').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteAT').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$('#ClientesNoAtendimento').find('.listaCliFiltrado').find('.NomeClienteAT').text(); 
                    $('#inputNomeClienteAT').val(NomeCliente);
                    $('#NovoAtendimento').modal('show');
                    $('#BuscaClienteAtendimento').modal('hide');
                ;
            },
        });
    }
}
document.addEventListener('DOMContentLoaded', function () {//Evita o envio com enter da modal NovoAtendimento
    var novoAtendimentoElement = document.getElementById('NovoAtendimento');
    
    if (novoAtendimentoElement) {
        novoAtendimentoElement.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const index = Array.from(this.elements).indexOf(document.activeElement) + 3;
                if (this.elements[index]) {
                    this.elements[index].focus();
                }
            }
        });
    }
});
$(function(){//Func Mascara Input DocAtendimento
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#inputCliAtendimento').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');

        if (val.length <= 11) {
            $('#cpf').val(val);
            $(this).val($('#cpf').masked());
            $('#cnpj_cpf').text('CPF');
        } else if(val.length>=14){
            $('#cnpj').val(val);
            $(this).val($('#cnpj').masked());
            $('#cnpj_cpf').text('CNPJ');
        }else{
            $('#cpf').val('');
            $('#cnpj').val('');
            $('#cnpj_cpf').text('CNPJ/CPF');
        }
    }).keyup(); // Chama o evento keyup imediatamente para aplicar a máscara inicial
});
$(document).ready(function() {//Valida CPF&CNPJ Agenda
    $('#btbuscaPorID_AT').on('click', function() {
        if((document.getElementById('inputCliAtendimento').value).length>0){
           
            if(((document.getElementById('inputCliAtendimento').value).length<14||(document.getElementById('inputCliAtendimento').value).length>18)||((document.getElementById('inputCliAtendimento').value).length>14&&(document.getElementById('inputCliAtendimento').value).length<18)){
                alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
            }else{
                buscaPorIdCliAt();
            }

        }else if((document.getElementById('razaoAT').value).length<3&&(document.getElementById('inputCliAtendimento').value).length<1){
            alert('Nome muito curto, verifique e tente novamente')

        }else{

            buscaPorIdCliAt();
        }
    });
});
function buscaPorIdCliAt() {//Filtra Cli por Doc Atendimetno
//Verifica se a busca é por Doc ou Nome
if((document.getElementById('inputCliAtendimento').value).length>0){
    var idCli = document.getElementById('inputCliAtendimento').value; 
    var campo='inputCliAtendimento';
}else{
    var idCli = document.getElementById('razaoAT').value; 
    var campo='razaoAT';
}

    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Atendimentos',
        type: 'POST',
        data: { [campo]: idCli },
        success: function(response) {
            
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaAtendimento').html();

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaAtendimento').hide();

            
            if(tabelaHtml.trim===''){
                $('#ClientesNoAtendimento').html('<tr><td colspan="5">Nenhum registro localizado</td></tr>');

            }else{
                $('#ClientesNoAtendimento').html(tabelaHtml);

                $('#ClientesNoAtendimento').find('.listaCliFiltrado').on('click',function() {

                    var CodCliente = $(this).find('.CodClienteAT').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteAT').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$(this).find('.NomeClienteAT').text(); 
                    $('#inputNomeClienteAT').val(NomeCliente);
                    $('#NovoAtendimento').modal('show');
                    $('#BuscaClienteAtendimento').modal('hide');
                });
            }    
        },
    });
}
$('#ClientesParaAtendimento').find('.listaCliFiltrado').on('click',function() {//Carrega cliente da lista para
    var CodCliente = $(this).find('.CodClienteAT').text() // Extrair o código correspondente do item clicado
    $('#inputCodClienteAT').val(CodCliente);//Atribui o valor ao compo Cod Cliente
    var NomeCliente=$(this).find('.NomeClienteAT').text(); 
    $('#inputNomeClienteAT').val(NomeCliente);
    $('#NovoAtendimento').modal('show');
    $('#BuscaClienteAtendimento').modal('hide');
});
$(document).ready(function() {
    // Adiciona um evento de submissão ao formulário
    $('form').submit(function() {
        // Remove o atributo 'disabled' do campo antes do envio
        $('#inputNomeClienteAT').removeAttr('disabled');
        $('#Operador').removeAttr('disabled');
        $('#Tipo').removeAttr('disabled');
    });
});

//Funções para Treinamento
$(document).ready(function() {//Valida CPF&CNPJ
    $('#btCliIdFiltroTreinamento').on('click', function() {
        if((document.getElementById('myInput').value).length>0){
           
            if(((document.getElementById('myInput').value).length<14||(document.getElementById('myInput').value).length>18)||((document.getElementById('myInput').value).length>14&&(document.getElementById('myInput').value).length<18)){
                alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
            }else{
                buscaPorIdTr();
            }

        }else if((document.getElementById('razaoFiltro').value).length<3&&(document.getElementById('myInput').value).length<1){
            alert('Nome muito curto, verifique e tente novamente')

        }else{

            buscaPorIdTr();
        }
    });
});
function buscaPorIdTr() { //Filtra Cli por Doc
    //Verifica se a busca é por Doc ou Nome
    if((document.getElementById('myInput').value).length>0){
        var idCli = document.getElementById('myInput').value; 
        var campo='myInput';
    }else{
        var idCli = document.getElementById('razaoFiltro').value; 
        var campo='razaoFiltro';
    }
    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Treinamentos',
        type: 'POST',
        data: { [campo]: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaFiltro').html();

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaFiltro').hide();


            if(tabelaHtml.trim===''){
                $('#ClientesJaFiltrado').html('<tr><td colspan="5">Nenhum registro localizado</td></tr>');
            }else{
                $('#ClientesJaFiltrado').html(tabelaHtml);

                $('#ClientesJaFiltrado').find('.listaCliFiltrado').on('click',function() {
                    var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
                    $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    $('#Filtro').modal('show');
                    $('#BuscaClienteFiltro').modal('hide');
                });
            }    
        },
    });
}
$(document).ready(function() {//espera ser digitado algum valor no campo cod cliente da Modal NovaTreinamento
    $('#inputCodClienteTR').on('keyup', function() {
        var idCli = $(this).val(); // Obtém o valor do campo inputCodClienteTR
        buscaIdCliTr(idCli); // Chama a função buscaIdCliTr com o valor digitado
 
    });
});
function buscaIdCliTr(idCli) {//Filtra Cli por Doc Treinamento
    //Chama a Rota que processa o filtro

    if(idCli!==null&&idCli!==''){
        $.ajax({
            url: '/Treinamentos',
            type: 'POST',
            data: { inputCliTreinamento: idCli },
            success: function(response) {
                //No sucesso traz uma view igual com os dados filtrados
                // Busca na view somente a Tabela em html e armazena na variável
                var tabelaHtml = $(response).find('#ClientesParaTreinamento').html();

                //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
                $('#ClientesParaTreinamento').hide();
                $('#ClientesNoTreinamento').html(tabelaHtml);
    
          
    
                    var CodCliente = $('#ClientesNoTreinamento').find('.listaCliFiltrado').find('.CodClienteTR').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteTR').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$('#ClientesNoTreinamento').find('.listaCliFiltrado').find('.NomeClienteTR').text(); 
                    $('#inputNomeClienteTR').val(NomeCliente);
                    $('#NovoTreinaemnto').modal('show');
                    $('#BuscaClienteTreinamento').modal('hide');
                ;
            },
        });
    }
}
document.addEventListener('DOMContentLoaded', function () {//Evita o envio com enter da modal NovoTreinamento
    var novoTreinamentoElement = document.getElementById('NovoTreinamento');
    
    if (novoTreinamentoElement) {
        novoTreinamentoElement.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const index = Array.from(this.elements).indexOf(document.activeElement) + 3;
                if (this.elements[index]) {
                    this.elements[index].focus();
                }
            }
        });
    }
});
$(function(){//Func Mascara Input DocTreinamento
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#inputCliTreinamento').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');

        if (val.length <= 11) {
            $('#cpf').val(val);
            $(this).val($('#cpf').masked());
            $('#cnpj_cpf').text('CPF');
        } else if(val.length>=14){
            $('#cnpj').val(val);
            $(this).val($('#cnpj').masked());
            $('#cnpj_cpf').text('CNPJ');
        }else{
            $('#cpf').val('');
            $('#cnpj').val('');
            $('#cnpj_cpf').text('CNPJ/CPF');
        }
    }).keyup(); // Chama o evento keyup imediatamente para aplicar a máscara inicial
});
$(document).ready(function() {//Valida CPF&CNPJ Treinamento
    $('#btbuscaPorID_TR').on('click', function() {
        if((document.getElementById('inputCliTreinamento').value).length>0){
           
            if(((document.getElementById('inputCliTreinamento').value).length<14||(document.getElementById('inputCliTreinamento').value).length>18)||((document.getElementById('inputCliTreinamento').value).length>14&&(document.getElementById('inputCliTreinamento').value).length<18)){
                alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
            }else{
                buscaPorIdCliTr();
            }

        }else if((document.getElementById('razaoTR').value).length<3&&(document.getElementById('inputCliTreinamento').value).length<1){
            alert('Nome muito curto, verifique e tente novamente')

        }else{

            buscaPorIdCliTr();
        }
    });
});
function buscaPorIdCliTr() {//Filtra Cli por Doc Treinamento

    if((document.getElementById('inputCliTreinamento').value).length>0){
        var idCli = document.getElementById('inputCliTreinamento').value; 
        var campo='inputCliTreinamento';
    }else{
        var idCli = document.getElementById('razaoTR').value; 
        var campo='razaoTR';
    }

    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Treinamentos',
        type: 'POST',
        data: { [campo]: idCli },
        success: function(response) {

            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaTreinamento').html();
            console.log(tabelaHtml);

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaTreinamento').hide();
            
            if(tabelaHtml.trim===''){
                 $('#ClientesNoTreinamento').html('<tr><td colspan="5">Nenhum registro localizado</td></tr>');

            }else{
                $('#ClientesNoTreinamento').html(tabelaHtml);

                $('#ClientesNoTreinamento').find('.listaCliFiltrado').on('click',function() {

                    var CodCliente = $(this).find('.CodClienteTR').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteTR').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$(this).find('.NomeClienteTR').text(); 
                    $('#inputNomeClienteTR').val(NomeCliente);
                    $('#NovoTreinamento').modal('show');
                    $('#BuscaClienteTreinamento').modal('hide');
                   
                });
            }    
        },
    });
}
$('#ClientesParaTreinamento').find('.listaCliFiltrado').on('click',function() {//Carrega cliente da lista para
    var CodCliente = $(this).find('.CodClienteTR').text() // Extrair o código correspondente do item clicado
    $('#inputCodClienteTR').val(CodCliente);//Atribui o valor ao compo Cod Cliente
    var NomeCliente=$(this).find('.NomeClienteTR').text(); 
    $('#inputNomeClienteTR').val(NomeCliente);
    $('#NovoTreinamento').modal('show');
    $('#BuscaClienteTreinamento').modal('hide');
});
$(document).ready(function() {
    // Adiciona um evento de submissão ao formulário
    $('form').submit(function() {
        // Remove o atributo 'disabled' do campo antes do envio
        $('#inputNomeClienteTR').removeAttr('disabled');
        $('#Operador').removeAttr('disabled');
        $('#Tipo').removeAttr('disabled');
    });
});


//whats
/*$(document).ready(function() {
    "use strict";

    // Função para inicializar o Perfect Scrollbar
    function initializeScrollbar() {
        $('.scrollable-chat-panel').perfectScrollbar();
        var position = $(".chat-search").last().position().top;
        $('.scrollable-chat-panel').scrollTop(position);
        $('.scrollable-chat-panel').perfectScrollbar('update');
        $('.pagination-scrool').perfectScrollbar();
    }

    // Função para lidar com os cliques nos gatilhos
    function handleTriggers() {
        $('.chat-upload-trigger').on('click', function(e) {
            $(this).parent().find('.chat-upload').toggleClass("active");
        });
        $('.user-detail-trigger, .user-undetail-trigger').on('click', function(e) {
            $(this).closest('.chat').find('.chat-user-detail').toggleClass("active");
        });
    }

    // Chamando as funções inicializadoras
    initializeScrollbar();
    handleTriggers();
});*/

