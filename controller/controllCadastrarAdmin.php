<?php
$host = "localhost";
$dbname = "hostdeprojetos_loveinmug";
$username = "hostdeprojetos";
$password = "ifspgru@2022";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

function limparCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        return false;
    }
    return $cpf;
}

function validarSenha($senha) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*\d.*\d.*\d).{6,}$/', $senha);
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}


$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$cpf = limparCPF($_REQUEST['cpf']);
$senha = $_REQUEST['senha'];
$codAcesso = $_REQUEST['codAcesso'];
$perfil = ($_REQUEST['perfil'] === 'administrador') ? 'administrador' : 'usuario';

try {
    // Verifique se o código de acesso é válido
    $stmtCodAcesso = $conn->prepare("SELECT codAcesso FROM verificacao WHERE codAcesso = ?");
    $stmtCodAcesso->execute([$codAcesso]);
    $resultCodAcesso = $stmtCodAcesso->fetch(PDO::FETCH_ASSOC);

    if (!$resultCodAcesso || $resultCodAcesso['codAcesso'] !== $codAcesso) {
        echo '<div id="result" class="error-message">Código de acesso inválido. Fale com o responsável.</div>';
    } else {
        if (!validarSenha($senha)) {
            echo '<div id="result" class="error-message">A senha deve ter pelo menos 6 caracteres, incluindo 4 números, uma letra maiúscula e uma letra minúscula.</div>';
        } elseif (!$cpf) {
            echo '<div id="result" class="error-message">CPF inválido.</div>';
        } elseif (!validarEmail($email)) {
            echo '<div id="result" class="error-message">E-mail inválido.</div>';
        } else {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM cadastrar WHERE email = ? OR cpf = ?");
            $stmt->execute([$email, $cpf]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo '<div id="result" class="error-message">Email ou CPF já cadastrado.</div>';
            } else {
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $sql = "INSERT INTO cadastrar (nome, email, cpf, senha, perfil) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt->execute([$nome, $email, $cpf, $senha_hash, $perfil])) {
                    echo '<div id="result" class="success-message">Cadastro realizado com sucesso.</div>';
                } else {
                    echo '<div id="result" class="error-message">Erro ao cadastrar. Verifique os dados e tente novamente.</div>';
                }
            }
        }
    }
} catch (PDOException $e) {
    echo '<div id="result" class="error-message">Erro: ' . $e->getMessage() . '</div>';
}

// Fecha a conexão
$conn = null;
?>
