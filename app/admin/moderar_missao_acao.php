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
    $missao_id = filter_input(INPUT_POST, 'missao_id', FILTER_VALIDATE_INT);
    $acao      = $_POST['acao'] ?? '';

    if ($missao_id) {
        try {
            if ($acao === 'excluir') {
                // Exclui a missão do mural independentemente de quem criou
                $stmt = $pdo->prepare("DELETE FROM missoes WHERE id = :id");
                $stmt->bindValue(':id', $missao_id, PDO::PARAM_INT);
                $stmt->execute();

                header('Location: moderar_missoes.php?status=excluido');
                exit;
            } 
            elseif ($acao === 'mudar_status') {
                $novo_status = $_POST['novo_status'] ?? 'Pendente';
                
                // Valida status permitidos
                $statusPermitidos = ['Pendente', 'Em Andamento', 'Concluída', 'Falhou'];
                if (in_array($novo_status, $statusPermitidos)) {
                    $stmt = $pdo->prepare("UPDATE missoes SET status = :status WHERE id = :id");
                    $stmt->bindValue(':status', $novo_status);
                    $stmt->bindValue(':id', $missao_id, PDO::PARAM_INT);
                    $stmt->execute();

                    header('Location: moderar_missoes.php?status=atualizado');
                    exit;
                }
            }
        } catch (PDOException $e) {
            die("Erro na moderação da missão: " . htmlspecialchars($e->getMessage()));
        }
    }
}

header('Location: moderar_missoes.php');
exit;

