$(document).ready(function() {
    $('#redefinir-senha-form').submit(function(event) {
        event.preventDefault();

        var loginEmail = $('input[name="loginEmail"]').val();
        var codAcesso = $('input[name="codAcesso"]').val();
        var novaSenha = $('input[name="novaSenha"]').val();

        $.ajax({
            type: 'POST',
            url: '../controller/controlProcessarRedefinicaoSenha.php',
            data: {
                loginEmail: loginEmail,
                codAcesso: codAcesso,
                novaSenha: novaSenha
            },
            success: function(response) {
                $('#result').html(response);

                // Verifica se a senha foi atualizada com sucesso
                if (response.includes('Senha atualizada com sucesso.')) {
                    // Obtém o perfil do usuário
                    var perfilDoUsuario = $('#perfil').text();

                    // Redireciona com base no perfil
                    if (perfilDoUsuario === 'administrador') {
                        window.location.href = '../view/painel.php';
                    } else if (perfilDoUsuario === 'usuario') {
                        window.location.href = '../view/painelUser.php';
                    } else {
                        // Perfil desconhecido, redirecione para uma página padrão
                        window.location.href = '../view/redefinir_senha.php';
                    }
                }
            },
            error: function() {
                $('#result').html('Erro ao processar a solicitação.');
            }
        });
    });
});
