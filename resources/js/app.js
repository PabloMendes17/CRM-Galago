import './bootstrap';

/*$(function(){
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#myInput').keyup(function(){
      const val = $(this).val().replace(/[^0-9]/g, '');
      console.log('val', val);
      if (val.length <= 11) {
        $('#cpf').val(val);
        $(this).val($('#cpf').masked());
        $('#cnpj_cpf').text('CPF');
      } else {
        $('#cnpj').val(val);
        $(this).val($('#cnpj').masked());
        $('#cnpj_cpf').text('CNPJ');
      }
    });
  });*/

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
        } else {
            $('#cnpj').val(val);
            $(this).val($('#cnpj').masked());
            $('#cnpj_cpf').text('CNPJ');
        }
    }).keyup(); // Chama o evento keyup imediatamente para aplicar a máscara inicial
});
  


 /* $(function(){
    $("#myInput").keyup(function(){
        //Recuperar o valor do campo
        var CNPJ_CPF = $(this).val();
        
        //Verificar se há algo digitado
        if(CNPJ_CPF != ''){
            var dados = {
                docCli : CNPJ_CPF
            }
            $.post('/AgendamentosFiltrados', dados, function(retorna){
                //Mostra dentro da ul os resultado obtidos 
                $(".resultado").html(retorna);
            });
        }
    });
});

$(function BuscarIdCli() {
  var idCli = document.getElementById('myInput').value;

  $.ajax({
      url: '/AgendamentosFiltrados',
      type: 'GET',
      data: {filtro: idCli},
      success: function(response) {
          var html = '<table><thead><tr><th>Código</th><th>Nome</th></tr></thead><tbody>';
          $.each(response, function(index, item) {
              html += '<tr><td>' + item.codigo + '</td><td>' + item.nome + '</td></tr>';
          });
          html += '</tbody></table>';

          $('#BuscaID').html(html);
          $('#modal').show();
      },
      error: function(xhr, status, error) {
          // Tratar erros, se necessário
      }
  });
});*/

/*$(function buscaPorID(){
  var valor=document.getElementById('myInput').value;
  console.log(valor);
  $.ajax({
    url: '/chamar-funcao/' + valor,
    type: 'GET',
    success: function(response) {
        // Lógica para lidar com a resposta, se necessário
        console.log(response);
    },
    error: function(xhr, status, error) {
        // Tratar erros, se necessário
    }
});
});*/
    


/*function chamarFuncaoDoController(valor) {
  $.ajax({
      url: '/chamar-funcao/' + valor,
      type: 'GET',
      success: function(response) {
          // Lógica para lidar com a resposta, se necessário
          console.log(response);
      },
      error: function(xhr, status, error) {
          // Tratar erros, se necessário
      }
  });
}*/