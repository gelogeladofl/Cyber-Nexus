<?php
session_start();

// 1. Limpa todas as variáveis armazenadas na sessão
$_SESSION = array();

// 2. Destrói o cookie da sessão no navegador, se existir
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

// 3. Destrói a sessão no servidor
session_destroy();

// 4. Redireciona o usuário para a página de login ou inicial
header('Location: /app/usuarios/index.php?status=deslogado');
exit;