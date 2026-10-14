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
    $agente_id = filter_input(INPUT_POST, 'agente_id', FILTER_VALIDATE_INT);
    $acao      = $_POST['acao'] ?? '';

    if ($agente_id) {
        try {
            if ($acao === 'excluir') {
                $stmt = $pdo->prepare("DELETE FROM agentes WHERE id = :id");
                $stmt->bindValue(':id', $agente_id, PDO::PARAM_INT);
                $stmt->execute();

                header('Location: moderar_agentes.php?status=excluido');
                exit;
            } 
            elseif ($acao === 'mudar_status') {
                $novo_status = $_POST['novo_status'] ?? 'Ativo';
                
                $statusPermitidos = ['Ativo', 'Desaparecido', 'Morto'];
                if (in_array($novo_status, $statusPermitidos)) {
                    $stmt = $pdo->prepare("UPDATE agentes SET status = :status WHERE id = :id");
                    $stmt->bindValue(':status', $novo_status);
                    $stmt->bindValue(':id', $agente_id, PDO::PARAM_INT);
                    $stmt->execute();

                    header('Location: moderar_agentes.php?status=atualizado');
                    exit;
                }
            }
        } catch (PDOException $e) {
            die("Erro ao processar ação do agente: " . htmlspecialchars($e->getMessage()));
        }
    }
}

header('Location: moderar_agentes.php');
exit;