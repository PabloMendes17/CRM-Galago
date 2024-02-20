import './bootstrap';

  $(function(){
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
$(document).ready(function() {
    $('#btbuscaPorID').on('click', function() {
        if((document.getElementById('myInput').value).length<14||(document.getElementById('myInput').value).length>18){

            alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
        }else{

            buscaPorID();
        }
    });
});

function buscaPorID() {
    //Captura o que está no campo CNPJ_CPF
    var idCli = document.getElementById('myInput').value;
    //Chama a Rota que processa o filtro
    $.ajax({
        url: '/AgendamentosFiltrados',
        type: 'POST',
        data: { myInput: idCli },
        success: function(response) {
            //No sucesso traz uma view igual com os dados filtrados
            // Busca na view somente a Tabela em html e armazena na variável
            var tabelaHtml = $(response).find('#ClientesParaFiltro').html();

            //Esconde a tab que está em exibição e chama a tab filtrada no lugar    
            $('#ClientesParaFiltro').hide();
            $('#ClientesJaFiltrado').html(tabelaHtml);

            $('#ClientesJaFiltrado').find('.listaCliFiltrado').click(function() {
                var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
                $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
                $('#Filtro').modal('show');
                $('#BuscaClienteFiltro').modal('hide');
            });
        },
    });
}

$('#ClientesParaFiltro').find('.listaCliFiltrado').click(function() {
    var CodCliente = $(this).find('.CodCliente').text() // Extrair o código correspondente do item clicado
    $('#inputCodCliente').val(CodCliente);//Atribui o valor ao compo Cod Cliente
    $('#Filtro').modal('show');
    $('#BuscaClienteFiltro').modal('hide');
});

$(function(){
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

$(document).ready(function() {
    $('#btbuscaPorID_AG').on('click', function() {
        if((document.getElementById('inputCliAgenda').value).length<14||(document.getElementById('inputCliAgenda').value).length>18){

            alert('O Valor Digitado não corresponde à um CNPJ ou CPF, porfavor digite novamente!')
        }else{

            buscaPorIdCLi();
        }
    });
});

function buscaPorIdCLi() {
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

            $('#ClientesNaAgenda').find('.listaCliFiltrado').click(function() {

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