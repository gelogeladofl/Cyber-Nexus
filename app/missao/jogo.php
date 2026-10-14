<?php
require_once __DIR__ . '/../../database/conexao.php';

try {
    $queryPrincipais = $pdo->query("SELECT * FROM missoes_principais ORDER BY id ASC");
    $missoesPrincipais = $queryPrincipais->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $missoesPrincipais = [];
    $erro_db = $e->getMessage();
}

$totalMissoes = count($missoesPrincipais);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Missões Principais</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 25px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// CAMPANHA PRINCIPAL — CYBERPUNK 2077</h1>
                <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Arquivos táticos e descrições confidenciais de contratos de alta prioridade.</p>
            </div>
            <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 0.95em;">
                [ TOTAL CATALOGADO: <?= $totalMissoes ?> ]
            </div>
        </div>

        <?php if (isset($erro_db)): ?>
            <div style="background: rgba(255, 0, 85, 0.1); border: 1px solid var(--neon-pink, #ff0055); padding: 15px; color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace;">
                ERRO DE CONEXÃO AO TERMINAL: <?= htmlspecialchars($erro_db) ?>
            </div>
        <?php else: ?>
            
            <!-- TABELA ESTILO TERMINAL WIKI -->
            <div style="overflow-x: auto; background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); box-shadow: 0 0 15px rgba(0,0,0,0.5);">
                <table style="width: 100%; border-collapse: collapse; font-family: 'Share Tech Mono', monospace; font-size: 0.95em;">
                    <thead>
                        <tr style="background: #111827; color: var(--neon-cyan, #00ffcc); text-align: left;">
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">#ID</th>
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">NOME DA MISSÃO</th>
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">DESCRIÇÃO TÁTICA</th>
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">ATO</th>
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">RISCO</th>
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">RECOMPENSA</th>
                            <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($missoesPrincipais)): ?>
                            <tr>
                                <td colspan="7" style="padding: 20px; text-align: center; color: var(--text-dim, #8b949e);">
                                    Nenhuma missão principal encontrada no banco de dados.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($missoesPrincipais as $item): ?>
                                <tr style="transition: background 0.2s;" onmouseover="this.style.background='var(--bg-panel-hover, #131b2c)'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-dim, #8b949e);"><?= $item['id'] ?></td>
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: #fff;">
                                        <strong><?= htmlspecialchars($item['nome']) ?></strong>
                                    </td>
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-main, #c9d1d9); font-size: 0.9em; max-width: 300px;">
                                        <?= htmlspecialchars($item['descricao']) ?>
                                    </td>
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-yellow, #fcee0a);">
                                        <?= htmlspecialchars($item['ato']) ?>
                                    </td>
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-pink, #ff0055);">
                                        <?= htmlspecialchars($item['dificuldade']) ?>
                                    </td>
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-cyan, #00ffcc); font-weight: bold;">
                                        €$ <?= number_format($item['recompensa'], 2, ',', '.') ?>
                                    </td>
                                    <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">
                                        <span style="font-weight: bold; color: <?= $item['status'] === 'Concluída' ? '#238636' : ($item['status'] === 'Em Andamento' ? '#58a6ff' : '#fcee0a') ?>;">
                                            <?= htmlspecialchars($item['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

        <div style="margin-top: 20px;">
            <a href="/app/missao/index.php" style="color: var(--neon-cyan, #00ffcc); text-decoration: none; font-family: 'Share Tech Mono', monospace;">&larr; Voltar ao Portal de Missões</a>
        </div>

    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>