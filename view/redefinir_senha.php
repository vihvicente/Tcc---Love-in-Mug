<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redefinição</title>
    <link rel="stylesheet" href="../public/css/style_login.css">
    <link rel="icon" href="../public/img/logo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">ESQUECEU A SENHA?</h2>
                <p class="description description-primary">Faça a redefinição</p>
                <p class="description description-primary">e volte a acessar</p>
                <button class="btn btn-primary" id="redirecionarLogin">Logar</button>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $('.btn-primary').click(function() {
                        // Redirecionar para a outra página
                        window.location.href = '../login.html';
                    });
                </script>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Redefinir Senha</h2>
                <form id="redefinir-senha-form" method="POST">
                    <label class="label-input" for="email">
                        <i class="fas fa-envelope icon-modify"></i>
                        <input type="email" id="email" name="loginEmail" placeholder="Email" required>
                    </label>

                    <label class="label-input" for="codAcesso">
                        <i class="fa fa-key icon-modify"></i>
                        <input type="text" id="codAcesso" name="codAcesso" placeholder="Código de Acesso" required>
                    </label>

                    <label class="label-input" for="novaSenha">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" id="novaSenha" name="novaSenha" placeholder="Nova Senha" required>
                    </label>

                    <div id="result"></div>

                    <button type="submit" class="btn btn-second">Redefinir</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../public/js/redefinir_senha.js"></script>
</body>
</html>
