<?php
$host = "localhost";
$dbname = "hostdeprojetos_loveinmug";
$username = "hostdeprojetos";
$password = "ifspgru@2022";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para validar a senha
    function validarSenha($senha) {
        // Senha deve ter no mínimo 6 caracteres, incluindo no mínimo 4 números, duas letras (uma sendo maiúscula)
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*\d.*\d.*\d).{6,}$/', $senha);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $loginEmail = $_POST['loginEmail'];
        $codAcesso = $_POST['codAcesso'];
        $novaSenha = $_POST['novaSenha'];

        // Verifique se o código de acesso está correto
        if ($codAcesso !== "0603-L") {
            echo '<div id="result" class="error-message">Código de acesso inválido. Fale com o responsável.</div>';
        } elseif (!validarSenha($novaSenha)) {
            echo '<div id="result" class="error-message">A senha não atende aos requisitos mínimos.</div>';
        } else {
            // Código de acesso correto, atualize a senha no banco de dados
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE cadastrar SET senha = ? WHERE email = ?");
            $stmt->execute([$senhaHash, $loginEmail]);

            if ($stmt->rowCount() > 0) {
                // Senha atualizada com sucesso
                echo '<div id="result" class="success-message">Senha atualizada com sucesso.</div>';
                
                // Obtém o perfil do usuário
                $stmtPerfil = $conn->prepare("SELECT perfil FROM cadastrar WHERE email = ?");
                $stmtPerfil->execute([$loginEmail]);
                $perfilDoUsuario = $stmtPerfil->fetchColumn();
                
                echo '<div id="perfil" class="hidden">' . $perfilDoUsuario . '</div>';

                // Restante do código...
            } else {
                echo '<div id="result" class="error-message">Nenhuma linha afetada. Verifique se o e-mail '.$loginEmail.' existe.</div>';
            }
        }

        // Fecha a conexão
        $conn = null;
    }
} catch (Exception $e) {
    echo '<div id="result" class="error-message">Erro: '.$e->getMessage().'</div>';
}
?>
