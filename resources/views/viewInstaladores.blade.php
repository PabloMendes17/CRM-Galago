<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="shortcut icon" href="icone/icone.ico" type="image/x-icon"> -->
    <title>Setups/Instaladores Gálago</title>
    <!-- <link rel="stylesheet" href="style.css">   -->  
</head>

<style>
    body{
        background: rgb(243, 241, 241);
        font-weight: bold;
        font-family: Arial;
        transition: .5s;
    }

    h1{
        text-align: center;
        padding: 5px;
    }

    .container {
        column-width: auto;
        column-gap: 10px;
        column-count: 4;
        padding: 1px;
        
    }

    .instaladores{
        /*break-inside: auto;*/
        page-break-inside: avoid;
        background-color: rgb(10, 8, 124);
        border: 2px solid rgb(6, 6, 10);
        color: beige;
        /*padding: 10px;*/
        margin: 0 0 1em 0;
        text-align: center;
        font-weight: bold;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 15px 10px 5px 5px;
        border-radius: 15px;
    }

    a{
        text-decoration: none;
        color: #FFF;
        background-color: black;
        margin: 0px;
        padding: 10px;
        border-radius: 3px;
        
    }
        
    .botao{
        border: solid 2px black;
        border-radius: 15px;
        color: white;
        background-color: black;
        transition: background-color 0.5s ease, color 0.5s ease, transform 0.5s ease;
    }

    .botao:hover{
        background-color: #02fc62;
        color: black;
        transform: scale(1.2)
    }

    @media screen and (max-width: 1169px){
        .instaladores{
            padding: 10px 8px 4px 4px;
        }

        .container{
            column-count: 4;
        }
    }

    @media screen and (max-width: 900px){
        .instaladores{
            padding: 8px 7px 3px 3px;
        }

        .container{
            column-count: 3;
        }
    }

    @media screen and (max-width: 700px){
        .instaladores{
            padding: 8px 7px 3px 3px;
        }

        .container{
            column-count: 2;
        }
    }

    @media screen and (max-width: 500px){
        .instaladores{
            padding: 6px 5px 2px 2px;
        }

        .container{
            column-count: 2;
        }
    }

    @media screen and (max-width: 390px){
        .instaladores{
            padding: 5px 4px 1px 1px;
        }

        .container{
            column-count: 1;
        }
    }

    .modo{
        width: 80px;
        height: 40px;
        background-color: #4d4d4d;
        border-radius: 150px;
        position: relative;
        cursor: pointer;
    }

    .modo .selecao{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #000;
        transform: scale(.9);
        position: absolute;
        left: 0;
        transition: .5s;
    }

    .modo.dark{
        background-color: #c3c3c3;
    }

    .modo.dark .selecao{
        left: 40px;
        background-color: #fff;
    }

    body.dark{
        background-color: #313131;
        color: #fff;
    }

    .estilo{
        float: right;
    }
    .home{
        float: left;
        margin-top: 1.5rem;
        border-radius: 15px;
        color: white;
        background-color: black;
        transition: background-color 0.5s ease, color 0.5s ease, transform 0.5s ease;
   }
</style>


<body>
    <div class="home">
    <a type="button" class="botao" onclick='href="/PaginaPrincipal"'>Pagina Principal</a>
    </div>
    <div class="estilo">
        <div>Dark/Light</div>
        <div class="modo" id="modo">
            <div class="selecao"></div>
        </div>
    </div>
    <!-- <script src="main.js"></script> -->
    <script>
        let modo = document.getElementById('modo');
        let body = document.querySelector('body');
    
        modo.addEventListener('click', ()=>{
            modo.classList.toggle('dark')
            body.classList.toggle('dark')
        })
    </script>

    <h1>Instaladores Gálago - Versão 4.0</h1>

    <div class="container">
            <div class="instaladores">
                <h3>Retaguarda Full 4.0</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/setup4.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Retaguarda Light 4.0</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/setup4light.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Retaguarda NFe 4.0</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/setup4nfe.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Firebird 2.5</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/firebird-2.5.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>PDV NFC-e</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instala-nfce.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>PDV SAT</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instala-sat.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>API Tráfego</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instala-apitrafego.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Tráfego</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/trafego.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Gsinc - NFC-e</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/gsincnfe.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>G-Mesa</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/gmesa.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>G-Mesa Mobile</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/gmesamobile.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Backup</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instalador-backup.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Consultor de Preços</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instala-tconsultas.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Módulo Fiscal</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instala-modulofiscal.exe">Download</a>
            </div>
    </div>

    <div>
        <h1>Aplicativo/API Pedido Eletrônico</h1>

        <div class="container">
            <div class="instaladores">
                <h3>API Pedido</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/instala-apipedido.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Pedido Eletrônico</h3>
                <a class="botao" target="_blank" href="https://play.google.com/store/apps/details?id=com.test.pedidoeletronicomobile">Download/PlayStore</a>
            </div>
        </div>
    </div>

    <div>
        <h1>Aplicações Web</h1>

        <div class="container">
            <div class="instaladores">
                <h3>Pedido Eletrônico</h3>
                <a class="botao" target="_blank" href="https://pedido.appgalago.com">Acessar Site</a>
            </div>
            <div class="instaladores">
                <h3>Consulta Mobile</h3>
                <a class="botao" target="_blank" href="https://mobile.appgalago.com">Acessar Site</a>
            </div>
        </div>
    </div>

    <div>
        <h1>Instaladores Gálago - Versão 2.4</h1>

        <div class="container">
            <div class="instaladores">
                <h3>Retaguarda Full</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/setup.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Retaguarda Light</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/setuplight.exe">Download</a>
            </div>
            <div class="instaladores">
                <h3>Retaguarda NFe</h3>
                <a class="botao" href="https://galago-app.s3-sa-east-1.amazonaws.com/instaladores/setupnfe.exe">Download</a>
            </div>
        </div>
    </div>
    <br>
</body>
</html>