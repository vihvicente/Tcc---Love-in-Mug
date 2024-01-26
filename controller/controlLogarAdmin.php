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

// Recupere os dados do formulário
$loginEmail = $_POST['loginEmail'];
$loginSenha = $_POST['loginSenha'];

// Verifique o login
$sql = "SELECT id, email, senha, perfil FROM cadastrar WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$loginEmail]);
$user = $stmt->fetch();

if ($user && password_verify($loginSenha, $user['senha'])) {
    // Login bem-sucedido. Armazene informações do usuário na sessão.
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_perfil'] = $user['perfil'];

    // Retorne uma resposta JSON para o redirecionamento no lado do cliente.
    $response = array('success' => true, 'message' => 'Login bem-sucedido.', 'perfil' => $user['perfil']);
    echo json_encode($response);
} else {
    // Login mal-sucedido. Retorne uma resposta JSON indicando o erro.
    $response = array('success' => false, 'message' => 'Email ou senha incorreto.');
    echo json_encode($response);
}
?>
