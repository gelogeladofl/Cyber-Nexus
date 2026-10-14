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

try {
    $stmt = $pdo->query("SELECT * FROM agentes ORDER BY id DESC");
    $agentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $agentes = [];
    $erro_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cyber Nexus — Gerenciamento de Agentes</title>
</head>
<body style="background-color: #0d1117; color: #c9d1d9; font-family: Arial, sans-serif; margin: 0; padding: 20px;">

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1000px; margin: 30px auto; padding: 20px; background: #161b22; border: 1px solid #30363d; border-radius: 6px;">
        <h2 style="color: #00ffcc; border-bottom: 1px solid #30363d; padding-bottom: 10px;">[ GERENCIAMENTO DE FICHAS DE AGENTES DA REDE ]</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'atualizado'): ?>
            <p style="color: #00ffcc; font-weight: bold;">Status do agente atualizado com sucesso!</p>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'excluido'): ?>
            <p style="color: #ff0055; font-weight: bold;">Ficha de agente removida da rede permanentemente.</p>
        <?php endif; ?>

        <?php if (isset($erro_db)): ?>
            <p style="color: #ff0055;">Erro ao carregar agentes: <?= htmlspecialchars($erro_db) ?></p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.95em;">
                <thead>
                    <tr style="background: #21262d; color: #8b949e; text-align: left;">
                        <th style="padding: 10px; border: 1px solid #30363d;">ID</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Codinome / Nome</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Função / Distrito</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Status Operacional</th>
                        <th style="padding: 10px; border: 1px solid #30363d; text-align: center;">Ações de Moderação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($agentes)): ?>
                        <tr>
                            <td colspan="5" style="padding: 15px; text-align: center; color: #8b949e;">Nenhum agente cadastrado no sistema.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($agentes as $a): ?>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #30363d;"><?= $a['id'] ?></td>
                                <td style="padding: 10px; border: 1px solid #30363d;">
                                    <strong style="color: #58a6ff; font-size: 1.1em;"><?= htmlspecialchars($a['codinome']) ?></strong><br>
                                    <span style="color: #8b949e; font-size: 0.85em;">Nome: <?= htmlspecialchars($a['nome']) ?></span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #30363d;">
                                    <span style="color: #fcee0a; font-weight: bold;"><?= htmlspecialchars($a['funcao']) ?></span><br>
                                    <span style="color: #8b949e; font-size: 0.85em;">Distrito: <?= htmlspecialchars($a['distrito']) ?></span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #30363d;">
                                    <span style="font-weight: bold; color: 
                                        <?= $a['status'] === 'Ativo' ? '#238636' : ($a['status'] === 'Desaparecido' ? '#fcee0a' : '#d73a49') ?>;">
                                        <?= htmlspecialchars($a['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #30363d; text-align: center;">
                                    <div style="display: flex; gap: 5px; justify-content: center; align-items: center;">
                                        <!-- Formulário para atualizar status -->
                                        <form action="moderar_agente_acao.php" method="POST" style="display: flex; gap: 5px;">
                                            <input type="hidden" name="agente_id" value="<?= $a['id'] ?>">
                                            <select name="novo_status" style="background: #0d1117; color: #c9d1d9; border: 1px solid #30363d; padding: 4px;">
                                                <option value="Ativo" <?= $a['status'] === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                                                <option value="Desaparecido" <?= $a['status'] === 'Desaparecido' ? 'selected' : '' ?>>Desaparecido</option>
                                                <option value="Morto" <?= $a['status'] === 'Morto' ? 'selected' : '' ?>>Morto</option>
                                            </select>
                                            <button type="submit" name="acao" value="mudar_status" style="background: #238636; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; font-size: 0.85em;">Atualizar</button>
                                        </form>

                                        <!-- Formulário para excluir -->
                                        <form action="moderar_agente_acao.php" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar permanentemente a ficha deste agente?');">
                                            <input type="hidden" name="agente_id" value="<?= $a['id'] ?>">
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
            <a href="index.php" style="color: #58a6ff; text-decoration: none;">&larr; Voltar ao Painel Admin</a>
        </p>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>