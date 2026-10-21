<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../database/conexao.php';

// Busca todas as missões da comunidade cadastradas
try {
    $query = $pdo->query("SELECT m.*, u.apelido AS criador_apelido FROM missoes m LEFT JOIN usuarios u ON m.criador_id = u.id ORDER BY m.criado_em DESC");
    $missoesMural = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $missoesMural = [];
    $erro_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Mural da Comunidade</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// MURAL DA COMUNIDADE — CONTRATOS E IDEIAS</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Cadastre suas próprias ideias de missões e compartilhe com os operacionais da rede.</p>
        </div>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'sucesso'): ?>
            <div style="background: rgba(0, 255, 204, 0.1); border: 1px solid var(--neon-cyan, #00ffcc); padding: 12px; margin-bottom: 25px; color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace;">
                [ TRANSMISSÃO CONCLUÍDA: Novo contrato registrado com sucesso no mural. ]
            </div>
        <?php endif; ?>

        <?php if (isset($erro_db)): ?>
            <div style="background: rgba(255, 0, 85, 0.1); border: 1px solid var(--neon-pink, #ff0055); padding: 12px; margin-bottom: 25px; color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace;">
                [ ERRO DE ACESSO AO BANCO: <?= htmlspecialchars($erro_db) ?> ]
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO DE CADASTRO (CREATE) -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; margin-bottom: 40px; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                // POSTAR NOVO CONTRATO / IDEIA
            </div>
            
            <form action="salvar_missao.php" method="POST">
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="flex: 2; min-width: 250px;">
                        <label for="nome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Título da Missão:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 150px;">
                        <label for="dificuldade" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Dificuldade (Risco):</label><br>
                        <select id="dificuldade" name="dificuldade" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Baixa">Baixa</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                            <option value="Extrema">Extrema</option>
                        </select>
                    </div>

                    <div style="flex: 1; min-width: 150px;">
                        <label for="recompensa" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Recompensa (€$):</label><br>
                        <input type="number" step="0.01" id="recompensa" name="recompensa" required placeholder="0.00" style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 150px;">
                        <label for="status" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Status Inicial:</label><br>
                        <select id="status" name="status" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Pendente">Pendente</option>
                            <option value="Em Andamento">Em Andamento</option>
                            <option value="Concluída">Concluída</option>
                            <option value="Falhou">Falhou</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label for="descricao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Briefing / Descrição Detalhada:</label><br>
                    <textarea id="descricao" name="descricao" rows="4" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px; resize: vertical;"></textarea>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" style="background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 10px 20px; font-family: 'Share Tech Mono', monospace; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.2s;">
                        PUBLICAR NO MURAL
                    </button>
                </div>
            </form>
        </div>

        <!-- LISTAGEM DE CONTRATOS -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2 style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; margin: 0;">// CONTRATOS POSTADOS</h2>
            <span style="color: var(--text-dim, #8b949e); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Total: <?= count($missoesMural) ?> registros</span>
        </div>

        <div style="overflow-x: auto; background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <table style="width: 100%; border-collapse: collapse; font-family: 'Share Tech Mono', monospace; font-size: 0.95em;">
                <thead>
                    <tr style="background: #111827; color: var(--neon-cyan, #00ffcc); text-align: left;">
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">TÍTULO / AUTOR</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">RISCO</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">RECOMPENSA</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">STATUS</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">BRIEFING</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); text-align: center;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($missoesMural)): ?>
                        <tr>
                            <td colspan="7" style="padding: 20px; text-align: center; color: var(--text-dim, #8b949e);">
                                Nenhuma ideia de missão cadastrada no mural ainda. Seja o primeiro a transmitir um contrato!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($missoesMural as $missao): ?>
                            <tr style="transition: background 0.2s;" onmouseover="this.style.background='var(--bg-panel-hover, #131b2c)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-dim, #8b949e);"><?= $missao['id'] ?></td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">
                                    <strong style="color: #fff; font-size: 1.05em;"><?= htmlspecialchars($missao['nome']) ?></strong><br>
                                    <span style="color: var(--text-dim, #8b949e); font-size: 0.85em;">Por: @<?= htmlspecialchars($missao['criador_apelido'] ?? 'Desconhecido') ?></span>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-pink, #ff0055);">
                                    <?= htmlspecialchars($missao['dificuldade']) ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-cyan, #00ffcc); font-weight: bold;">
                                    €$ <?= number_format($missao['recompensa'], 2, ',', '.') ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">
                                    <span style="font-weight: bold; color: <?= $missao['status'] === 'Concluída' ? '#238636' : ($missao['status'] === 'Em Andamento' ? '#58a6ff' : '#fcee0a') ?>;">
                                        <?= htmlspecialchars($missao['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-main, #c9d1d9); font-size: 0.9em; max-width: 250px;">
                                    <?= htmlspecialchars(html_entity_decode($missao['descricao'], ENT_QUOTES, 'UTF-8')) ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="editar_missao.php?id=<?= $missao['id'] ?>" style="background: #1f6feb; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Editar</a>
                                        <a href="excluir_missao.php?id=<?= $missao['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta missão do mural?')" style="background: #d73a49; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 25px;">
            <a href="/app/missao/index.php" style="color: var(--neon-cyan, #00ffcc); text-decoration: none; font-family: 'Share Tech Mono', monospace;">&larr; Voltar ao Portal de Missões</a>
        </div>

    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>