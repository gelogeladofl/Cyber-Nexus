<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se é Admin
if (!isset($_SESSION['usuario_nivel']) || strcasecmp(trim($_SESSION['usuario_nivel']), 'Admin') !== 0) {
    header('Location: /app/usuarios/index.php?erro=acesso_negado');
    exit;
}

require_once __DIR__ . '/../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = filter_input(INPUT_POST, 'usuario_id', );
    $novo_nivel = filter_input(INPUT_POST, 'novo_nivel', );

    // Valida se os dados são aceitáveis ('Admin' ou 'Operador')
    if ($usuario_id && ($novo_nivel === 'Admin' || $novo_nivel === 'Operador')) {
        
        // Proteção extra: impedir que o admin logado altere o próprio nível por acidente
        if ($usuario_id == $_SESSION['usuario_id'] && $novo_nivel === 'Operador') {
            header('Location: usuarios.php?erro=auto_rebaixamento');
            exit;
        }

        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET nivel_acesso = :nivel WHERE id = :id");
            $stmt->bindValue(':nivel', $novo_nivel);
            $stmt->bindValue(':id', $usuario_id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: usuarios.php?status=atualizado');
            exit;
        } catch (PDOException $e) {
            die("Erro ao atualizar nível: " . htmlspecialchars($e->getMessage()));
        }
    }
}

header('Location: usuarios.php');
exit;