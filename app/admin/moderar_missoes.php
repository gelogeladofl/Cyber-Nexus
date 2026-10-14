<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Restringe o acesso apenas para Administradores
if (!isset($_SESSION['usuario_nivel']) || strcasecmp(trim($_SESSION['usuario_nivel']), 'Admin') !== 0) {
    header('Location: /app/usuarios/index.php?erro=acesso_negado');
    exit;
}

require_once __DIR__ . '/../../database/conexao.php';

// Busca todas as missões do mural com os dados do criador e do agente responsável
try {
    $sql = "
        SELECT m.*, 
               uc.apelido AS criador_apelido, 
               ua.apelido AS agente_apelido
        FROM missoes m
        LEFT JOIN usuarios uc ON m.criador_id = uc.id
        LEFT JOIN usuarios ua ON m.agente_id = ua.id
        ORDER BY m.criado_em DESC
    ";
    $stmt = $pdo->query($sql);
    $missoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $missoes = [];
    $erro_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cyber Nexus — Moderação do Mural</title>
</head>
<body style="background-color: #0d1117; color: #c9d1d9; font-family: Arial, sans-serif; margin: 0; padding: 20px;">

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1000px; margin: 30px auto; padding: 20px; background: #161b22; border: 1px solid #30363d; border-radius: 6px;">
        <h2 style="color: #00ffcc; border-bottom: 1px solid #30363d; padding-bottom: 10px;">[ MODERAÇÃO DE CONTRATOS E IDEIAS NO MURAL ]</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'excluido'): ?>
            <p style="color: #00ffcc; font-weight: bold;">Contrato removido com sucesso pela moderação!</p>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'atualizado'): ?>
            <p style="color: #00ffcc; font-weight: bold;">Status da missão atualizado com sucesso!</p>
        <?php endif; ?>

        <?php if (isset($erro_db)): ?>
            <p style="color: #ff0055;">Erro ao carregar missões: <?= htmlspecialchars($erro_db) ?></p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.95em;">
                <thead>
                    <tr style="background: #21262d; color: #8b949e; text-align: left;">
                        <th style="padding: 10px; border: 1px solid #30363d;">ID</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Contrato / Dificuldade</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Criador / Agente</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Status Atual</th>
                        <th style="padding: 10px; border: 1px solid #30363d; text-align: center;">Ações de Moderação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($missoes)): ?>
                        <tr>
                            <td colspan="5" style="padding: 15px; text-align: center; color: #8b949e;">Nenhum contrato cadastrado no mural.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($missoes as $m): ?>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #30363d;"><?= $m['id'] ?></td>
                                <td style="padding: 10px; border: 1px solid #30363d;">
                                    <strong><?= htmlspecialchars($m['nome']) ?></strong><br>
                                    <span style="color: #8b949e; font-size: 0.85em;">Risco: <?= htmlspecialchars($m['dificuldade']) ?> | Recompensa: €$ <?= number_format($m['recompensa'], 2, ',', '.') ?></span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #30363d; font-size: 0.9em;">
                                    Criador: <span style="color: #58a6ff;">@<?= htmlspecialchars($m['criador_apelido'] ?? 'Sistema/Desconhecido') ?></span><br>
                                    Assumido por: <span style="color: #fcee0a;"><?= $m['agente_apelido'] ? '@' . htmlspecialchars($m['agente_apelido']) : 'Ninguém (Pendente)' ?></span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #30363d;">
                                    <span style="font-weight: bold; color: 
                                        <?= $m['status'] === 'Pendente' ? '#fcee0a' : ($m['status'] === 'Em Andamento' ? '#58a6ff' : ($m['status'] === 'Concluída' ? '#238636' : '#d73a49')) ?>;">
                                        <?= htmlspecialchars($m['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #30363d; text-align: center;">
                                    <!-- Formulário para alterar status ou excluir -->
                                    <div style="display: flex; gap: 5px; justify-content: center; align-items: center;">
                                        <form action="moderar_missao_acao.php" method="POST" style="display: flex; gap: 5px;">
                                            <input type="hidden" name="missao_id" value="<?= $m['id'] ?>">
                                            <select name="novo_status" style="background: #0d1117; color: #c9d1d9; border: 1px solid #30363d; padding: 4px;">
                                                <option value="Pendente" <?= $m['status'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                                                <option value="Em Andamento" <?= $m['status'] === 'Em Andamento' ? 'selected' : '' ?>>Em Andamento</option>
                                                <option value="Concluída" <?= $m['status'] === 'Concluída' ? 'selected' : '' ?>>Concluída</option>
                                                <option value="Falhou" <?= $m['status'] === 'Falhou' ? 'selected' : '' ?>>Falhou</option>
                                            </select>
                                            <button type="submit" name="acao" value="mudar_status" style="background: #238636; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; font-size: 0.85em;">Atualizar</button>
                                        </form>

                                        <form action="moderar_missao_acao.php" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar permanentemente este contrato do mural?');">
                                            <input type="hidden" name="missao_id" value="<?= $m['id'] ?>">
                                            <button type="submit" name="acao" value="excluir" style="background: #d73a49; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; font-size: 0.85em;">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <p style="margin-top: 20px;">
            <a href="dashboard.php" style="color: #58a6ff; text-decoration: none;">&larr; Voltar ao Painel Admin</a>
        </p>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>