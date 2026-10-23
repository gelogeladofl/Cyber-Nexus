<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitização simples dos campos
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    if (!empty($login) && !empty($senha)) {
        try {
            // Busca o usuário por E-mail OU Apelido
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE LOWER(email) = LOWER(:login) OR LOWER(apelido) = LOWER(:login)");
            $stmt->bindValue(':login', $login);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Se o usuário não existir
            if (!$usuario) {
                die("<h3 style='color: red;'>Erro: Usuário/E-mail '{$login}' não foi encontrado no banco de dados.</h3><a href='index.php'>Voltar</a>");
            }

            // Testa a verificação da senha (Hash BCRYPT)
            if (password_verify($senha, $usuario['senha'])) {
                // REGISTRA OS DADOS NA SESSÃO
                $_SESSION['usuario_id']      = $usuario['id'];
                $_SESSION['usuario_nome']    = $usuario['nome'];
                $_SESSION['usuario_apelido'] = $usuario['apelido'];
                $_SESSION['usuario_nivel']   = $usuario['nivel_acesso'];

                // Garante a gravação dos dados em disco/memória
                session_write_close();

                // Redireciona para o portal principal
                header('Location: /cyber-nexus/index.php');
                exit;
            } else {
                die("<h3 style='color: red;'>Erro: Senha incorreta para o usuário '{$login}'.</h3><a href='index.php'>Voltar</a>");
            }

        } catch (PDOException $e) {
            die("<h3 style='color: red;'>Erro de Banco de Dados: " . htmlspecialchars($e->getMessage()) . "</h3>");
        }
    } else {
        die("<h3 style='color: red;'>Erro: Preencha todos os campos do formulário.</h3><a href='index.php'>Voltar</a>");
    }
}

// Se tentar acessar o script via GET sem enviar o formulário
header('Location: index.php');
exit;