<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../database/conexao.php';

try {
    $query = $pdo->query("SELECT * FROM agentes ORDER BY criado_em DESC");
    $agentes = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $agentes = [];
    $erro_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Registro de Agentes</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// AGENTES DA REDE — FIXERS & MERCENÁRIOS</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Cadastre e gerencie o perfil dos operacionais ativos em Night City.</p>
        </div>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'sucesso'): ?>
            <div style="background: rgba(0, 255, 204, 0.1); border: 1px solid var(--neon-cyan, #00ffcc); padding: 12px; margin-bottom: 25px; color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace;">
                [ TRANSMISSÃO CONCLUÍDA: Operação realizada com sucesso no registro de agentes. ]
            </div>
        <?php endif; ?>

        <?php if (isset($erro_db)): ?>
            <div style="background: rgba(255, 0, 85, 0.1); border: 1px solid var(--neon-pink, #ff0055); padding: 12px; margin-bottom: 25px; color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace;">
                [ ERRO DE ACESSO AO BANCO: <?= htmlspecialchars($erro_db) ?> ]
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO DE CADASTRO -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; margin-bottom: 40px; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                // REGISTRAR NOVO AGENTE
            </div>
            
            <form action="salvar_agente.php" method="POST">
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    
                    <div style="flex: 1; min-width: 250px;">
                        <label for="nome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Nome Real:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 250px;">
                        <label for="codinome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Codinome / Alcunha:</label><br>
                        <input type="text" id="codinome" name="codinome" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 150px;">
                        <label for="funcao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Função:</label><br>
                        <select id="funcao" name="funcao" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Fixer">Fixer</option>
                            <option value="Mercenário">Mercenário</option>
                            <option value="Netrunner">Netrunner</option>
                            <option value="Techie">Techie</option>
                            <option value="Solo">Solo</option>
                        </select>
                    </div>

                </div>

                <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 15px;">
                    
                    <div style="flex: 2; min-width: 250px;">
                        <label for="distrito" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Distrito de Atuação:</label><br>
                        <input type="text" id="distrito" name="distrito" required placeholder="Ex: Watson, Heywood, Pacífica" style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 180px;">
                        <label for="reputacao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Reputação:</label><br>
                        <select id="reputacao" name="reputacao" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Baixa">Baixa</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                            <option value="Lenda">Lenda de Night City</option>
                        </select>
                    </div>

                    <div style="flex: 1; min-width: 150px;">
                        <label for="status" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Status Operacional:</label><br>
                        <select id="status" name="status" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Ativo">Ativo</option>
                            <option value="Desaparecido">Desaparecido</option>
                            <option value="Morto">Morto</option>
                        </select>
                    </div>

                </div>

                <div style="margin-top: 15px;">
                    <label for="biografia" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Biografia / Histórico:</label><br>
                    <textarea id="biografia" name="biografia" rows="4" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px; resize: vertical;"></textarea>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" style="background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 10px 20px; font-family: 'Share Tech Mono', monospace; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.2s;">
                        CADASTRAR AGENTE
                    </button>
                </div>
            </form>
        </div>

        <!-- LISTAGEM DOS AGENTES -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2 style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; margin: 0;">// AGENTES REGISTRADOS NA REDE</h2>
            <span style="color: var(--text-dim, #8b949e); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Total: <?= count($agentes) ?> operacionais</span>
        </div>

        <div style="overflow-x: auto; background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <table style="width: 100%; border-collapse: collapse; font-family: 'Share Tech Mono', monospace; font-size: 0.95em;">
                <thead>
                    <tr style="background: #111827; color: var(--neon-cyan, #00ffcc); text-align: left;">
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">CODINOME / NOME</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">FUNÇÃO</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">DISTRITO</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">REPUTAÇÃO</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">STATUS</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">BIOGRAFIA</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); text-align: center;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($agentes)): ?>
                        <tr>
                            <td colspan="7" style="padding: 20px; text-align: center; color: var(--text-dim, #8b949e);">
                                Nenhum agente cadastrado no banco de dados.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($agentes as $agente): ?>
                            <tr style="transition: background 0.2s;" onmouseover="this.style.background='var(--bg-panel-hover, #131b2c)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">
                                    <strong style="color: #fff; font-size: 1.05em;"><?= htmlspecialchars($agente['codinome']) ?></strong><br>
                                    <span style="color: var(--text-dim, #8b949e); font-size: 0.85em;">Real: <?= htmlspecialchars($agente['nome']) ?></span>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-cyan, #00ffcc);">
                                    <?= htmlspecialchars($agente['funcao']) ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-main, #c9d1d9);">
                                    <?= htmlspecialchars($agente['distrito']) ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-yellow, #fcee0a);">
                                    <?= htmlspecialchars($agente['reputacao']) ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">
                                    <span style="font-weight: bold; color: <?= $agente['status'] === 'Ativo' ? '#238636' : ($agente['status'] === 'Desaparecido' ? '#fcee0a' : '#d73a49') ?>;">
                                        <?= htmlspecialchars($agente['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-main, #c9d1d9); font-size: 0.9em; max-width: 250px;">
                                    <?= htmlspecialchars(html_entity_decode($agente['biografia'], ENT_QUOTES, 'UTF-8')) ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="editar_agente.php?id=<?= $agente['id'] ?>" style="background: #1f6feb; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Editar</a>
                                        <a href="excluir_agente.php?id=<?= $agente['id'] ?>" onclick="return confirm('Tem certeza que deseja remover este agente?')" style="background: #d73a49; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 25px;">
            <a href="/index.php" style="color: var(--neon-cyan, #00ffcc); text-decoration: none; font-family: 'Share Tech Mono', monospace;">&larr; Voltar ao Terminal Central</a>
        </div>

    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>

