<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>CRM-Suporte</title>
</head>
<body>
    <div class="login">
        <div class="credenciais" id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <img class="logoSignin mx 8" src="images/logogalago.png"/>
                                    <h4 class="text-center font-weight-light my-4">Acesse </h4>
                                    <h6 class="text-center font-weight-light my-4">E registre seu Atendimento </h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('autenticar') }}">
					                    @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger" role="alert">
                                                <p>{{ $errors->first('email') }}</p>
                                            </div>
                                        @endif
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" 
                                            @if(isset($_COOKIE["email"])) value="{{decrypt($_COOKIE['email'])}}" @endif required/>
                                            <label for="inputEmail">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" 
                                            @if(isset($_COOKIE["password"])) value="{{decrypt($_COOKIE['password'])}}" @endif required/>
                                            <label for="inputPassword">Senha</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" 
                                            @if(isset($_COOKIE["email"])) checked @endif name="remember">
                                            <label class="form-check-label" for="inputRememberPassword">Lembrar Credenciais</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" id="btnLogin" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class=footer id="layoutAuthentication_footer">
            <footer class="py-1 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">
                            Copyright &copy; Galago 2024
                        </div>
                        <div>
                            <a href="/Politicas">Politicas de Privacidade</a>
                            &middot;
                            <a href="/Politicas">Termos &amp; Uso</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>