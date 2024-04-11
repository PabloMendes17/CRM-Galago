<html>
    <p>Funcionando</p><br>

    <?php
        dd(Auth::check())
    ?>
  
    @if (Auth::check())
        <p>{{Auth::user()->EMAIL}}</p>
        <p>{{Auth::user()->NOME}}</p>
        <p>{{Auth::user()->SENHA}}</p>
    @endif

</html>