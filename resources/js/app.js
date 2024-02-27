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
    document.getElementById('horaAtual').innerText = horaFormatada;
}
atualizarHora();
setInterval(atualizarHora, 1000);

//Funções para viewAgenda
  $(function(){//Func Mascara Input DocFiltro
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#myInput').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');
        console.log('val', val);
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
$(document).ready(function() {//Valida CPF&CNPJ
    $('#btbuscaPorID').on('click', function() {
        if(((document.getElementById('myInput').value).length<14||(document.getElementById('myInput').value).length>18)||((document.getElementById('myInput').value).length>14&&(document.getElementById('myInput').value).length<18)){

            alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
        }else{

            buscaPorID();
        }
    });
});
function buscaPorID() { //Filtra Cli por Doc
    //Captura o que está no campo CNPJ_CPF
    var idCli = document.getElementById('myInput').value;
    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Agendamentos',
        type: 'POST',
        data: { myInput: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaFiltro').html();


            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaFiltro').hide();
            $('#ClientesJaFiltrado').html(tabelaHtml);

            $('#ClientesJaFiltrado').find('.listaCliFiltrado').on('click',function() {
                var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
                $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                $('#Filtro').modal('show');
                $('#BuscaClienteFiltro').modal('hide');
            });
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
                console.log(tabelaHtml);
                //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
                $('#ClientesParaAgenda').hide();
                $('#ClientesNaAgenda').html(tabelaHtml);
    
          
    
                    var CodCliente = $('#ClientesNaAgenda').find('.listaCliFiltrado').find('.CodClienteAG').text();// Extrair o código correspondente do item clicado
                    $('#inputCodClienteAG').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                    var NomeCliente=$('#ClientesNaAgenda').find('.listaCliFiltrado').find('.NomeClienteAG').text(); 
                    $('#inputNomeClienteAG').val(NomeCliente);
                    $('#NovaAgenda').modal('show');
                    $('#BuscaClienteAgenda').modal('hide');
                ;
            },
        });
    }
}
document.addEventListener('DOMContentLoaded', function () {//Evita o envio com enter da modal NovaAgenda
    document.getElementById('NovaAgenda').addEventListener('keydown', function (event) {
        
        if (event.key === 'Enter') {
            
            event.preventDefault();
            const index = Array.from(this.elements).indexOf(document.activeElement) + 3;

            if (this.elements[index]) {
                this.elements[index].focus();
            }
        }
    });
});
$(function(){//Func Mascara Input DocAgenda
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#inputCliAgenda').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');
        console.log('val', val);
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
    $('#btbuscaPorID_AG').on('click', function() {
        if(((document.getElementById('inputCliAgenda').value).length<14||(document.getElementById('inputCliAgenda').value).length>18)||((document.getElementById('inputCliAgenda').value).length>14&&(document.getElementById('inputCliAgenda').value).length<18)){

            alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
        }else{

            buscaPorIdCLi();
        }
    });
});
function buscaPorIdCLi() {//Filtra Cli por Doc Agenda
    //Captura o que está no campo CNPJ_CPF
    var idCli = document.getElementById('inputCliAgenda').value;
    //Chama a Rota que processa o filtro
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

            $('#ClientesNaAgenda').find('.listaCliFiltrado').on('click',function() {

                var CodCliente = $(this).find('.CodClienteAG').text();// Extrair o código correspondente do item clicado
                $('#inputCodClienteAG').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                var NomeCliente=$(this).find('.NomeClienteAG').text(); 
                $('#inputNomeClienteAG').val(NomeCliente);
                $('#NovaAgenda').modal('show');
                $('#BuscaClienteAgenda').modal('hide');
            });
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

//Funções para viewAtendimento
$(document).ready(function() {//Valida CPF&CNPJ
    $('#btCliIdFiltroAtendimento').on('click', function() {
        if(((document.getElementById('myInput').value).length<14||(document.getElementById('myInput').value).length>18)||((document.getElementById('myInput').value).length>14&&(document.getElementById('myInput').value).length<18)){

            alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
        }else{

            cliIdFiltroAtendimento();
        }
    });
});
function cliIdFiltroAtendimento() { //Filtra Cli por Doc
    //Captura o que está no campo CNPJ_CPF
    var idCli = document.getElementById('myInput').value;

    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Atendimentos',
        type: 'POST',
        data: { myInput: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaFiltro').html();
            console.log(tabelaHtml);

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaFiltro').hide();
            $('#ClientesJaFiltrado').html(tabelaHtml);

            $('#ClientesJaFiltrado').find('.listaCliFiltrado').on('click',function() {
                var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
                $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                $('#Filtro').modal('show');
                $('#BuscaClienteFiltro').modal('hide');
            });
        },
    });
}
$(document).ready(function() {//espera ser digitado algum valor no campo cod cliente da Modal NovaAgenda
    $('#inputCodClienteAT').on('keyup', function() {
        var idCli = $(this).val(); // Obtém o valor do campo inputCodClienteAG
        buscaCliIdFiltroAtendimento(idCli); // Chama a função buscaPorIdCli com o valor digitado
 
    });
});
function buscaCliIdFiltroAtendimento(idCli) {//Filtra Cli por Doc Atendimento
    //Chama a Rota que processa o filtro

    if(idCli!==null&&idCli!==''){
        $.ajax({
            url: '/Atendimentos',
            type: 'POST',
            data: { inputCliAgenda: idCli },
            success: function(response) {
                //No sucesso traz uma view igual com os dados filtrados
                // Busca na view somente a Tabela em html e armazena na variável
                var tabelaHtml = $(response).find('#ClientesParaAtendimento').html();
                console.log(tabelaHtml);
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
    document.getElementById('NovoAtendimento').addEventListener('keydown', function (event) {
        
        if (event.key === 'Enter') {
            
            event.preventDefault();
            const index = Array.from(this.elements).indexOf(document.activeElement) + 3;

            if (this.elements[index]) {
                this.elements[index].focus();
            }
        }
    });
});
$(function(){//Func Mascara Input DocAtendimento
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#inputCliAtendimento').keyup(function(){
        const val = $(this).val().replace(/[^0-9]/g, '');
        console.log('val', val);
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
$(document).ready(function() {//Valida CPF&CNPJ Atendimento
    $('#btbuscaPorID_AT').on('click', function() {
        if(((document.getElementById('inputCliAtendimento').value).length<14||(document.getElementById('inputCliAtendimento').value).length>18)||((document.getElementById('inputCliAtendimento').value).length>14&&(document.getElementById('inputCliAtendimento').value).length<18)){

            alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
        }else{

            buscaCliIdAtendimento();
        }
    });
});
function buscaCliIdAtendimento() {//Filtra Cli por Doc Agenda
    //Captura o que está no campo CNPJ_CPF
    var idCli = document.getElementById('inputCliAtendimento').value;
    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/Atendimentos',
        type: 'POST',
        data: { inputCliAtendimento: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaAtendimento').html();
            console.log(tabelaHtml);

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaAtendimento').hide();
            $('#ClientesNoAtendimento').html(tabelaHtml);

            $('#ClientesNoAtendimento').find('.listaCliFiltrado').on('click',function() {

                var CodCliente = $(this).find('.CodClienteAT').text();// Extrair o código correspondente do item clicado
                $('#inputCodClienteAT').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                var NomeCliente=$(this).find('.NomeClienteAT').text(); 
                $('#inputNomeClienteAT').val(NomeCliente);
                $('#NovoAtendimento').modal('show');
                $('#BuscaClienteAtendimento').modal('hide');
            });
        },
    });
}