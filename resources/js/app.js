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
      } else {
        $('#cnpj').val(val);
        $(this).val($('#cnpj').masked());
        $('#cnpj_cpf').text('CNPJ');
      }
    });
  });

 /* $(function(){
    $("#cnpj_cpf").keyup(function(){
      //Recuperar o valor do campo
      var cnpj_cpf = $(this).val();
      
      //Verificar se há algo digitado
      if(cnpj_cpf != ''){
        var dados = {
          palavra : cnpj_cpf
        }
        $.post('viewAgendamentosFiltrados.blade.php', dados, function(retorna){
          //Mostra dentro da ul os resultado obtidos 
          $(".resultado").html(retorna);
        });
      }
    });
  });  */

  $(function(){
    $("#cnpj_cpf").keyup(function(){
      // Recuperar o valor do campo
      var cnpj_cpf = $(this).val();
      
      // Verificar se há algo digitado
      if(cnpj_cpf != ''){
        var dados = {
          cnpj_cpf: cnpj_cpf
        };
  
        // Fazer a requisição AJAX para a rota de pesquisa definida no Laravel
        $.ajax({
          type: 'POST',
          url: '/AtendimentosFiltrados',
          data: dados,
          success: function(response) {
            // Limpar a lista de resultados
            $(".resultado").empty();
  
            // Adicionar os resultados à lista
            response.forEach(function(clientes) {
              $(".resultado").append("<th scope='col'>" + clientes.nome + "</th>");
            });
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
    });
  });
  