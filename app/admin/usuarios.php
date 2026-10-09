<?php
session_start();

// Se não estiver logado OU não for Admin, redireciona para a página inicial
if (!isset($_SESSION['usuario_nivel']) || $_SESSION['usuario_nivel'] !== 'Admin') {
    header('Location: ../../index.php?erro=acesso_negado');
    exit;
}
?>