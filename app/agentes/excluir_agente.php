<?php
require_once __DIR__ . '/../../database/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM agentes WHERE id = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        die("Erro ao excluir registro: " . $e->getMessage());
    }
}

header('Location: index.php');
exit;