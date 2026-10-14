<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se é Administrador
if (!isset($_SESSION['usuario_nivel']) || strcasecmp(trim($_SESSION['usuario_nivel']), 'Admin') !== 0) {
    header('Location: /app/usuarios/index.php?erro=acesso_negado');
    exit;
}

require_once __DIR__ . '/../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $implante_id = filter_input(INPUT_POST, 'implante_id', FILTER_VALIDATE_INT);
    $acao        = $_POST['acao'] ?? '';

    if ($implante_id && $acao === 'excluir') {
        try {
            // Remove o implante e vínculos associados se houver restrição em cascata configurada
            $stmt = $pdo->prepare("DELETE FROM implantes WHERE id = :id");
            $stmt->bindValue(':id', $implante_id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: moderar_implantes.php?status=excluido');
            exit;
        } catch (PDOException $e) {
            die("Erro ao excluir implante: " . htmlspecialchars($e->getMessage()));
        }
    }
}

header('Location: moderar_implantes.php');
exit;