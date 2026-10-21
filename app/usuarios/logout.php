<?php
// 1. Inicia/recupera a sessão atual
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Limpa todas as variáveis armazenadas na sessão
$_SESSION = array();

// 3. Destrói o cookie da sessão no navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 4. Destrói a sessão no servidor
session_destroy();

// 5. Redireciona o usuário para a tela de login com mensagem de confirmação
header('Location: /aa/app/usuarios/index.php?status=deslogado');
exit;