<?php
session_start();
require_once __DIR__ . '/../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    if (!empty($login) && !empty($senha)) {
        try {
            // Permite login usando tanto o e-mail quanto o apelido de rede
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :login OR apelido = :login");
            $stmt->bindValue(':login', $login);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Valida o hash da senha
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id']      = $usuario['id'];
                $_SESSION['usuario_nome']    = $usuario['nome'];
                $_SESSION['usuario_apelido'] = $usuario['apelido'];
                $_SESSION['usuario_nivel']   = $usuario['nivel_acesso'];

                header('Location: ../../index.php');
                exit;
            } else {
                die("<strong>Erro de Autenticação:</strong> Usuário ou senha incorretos.");
            }
        } catch (PDOException $e) {
            die("<strong>Erro:</strong> " . htmlspecialchars($e->getMessage()));
        }
    }
}

header('Location: index.php');
exit;