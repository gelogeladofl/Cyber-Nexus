<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../database/conexao.php';

$implantes = [];

try {
    $stmt = $pdo->query("SELECT * FROM implantes ORDER BY id DESC");
    $implantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erro_db = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Implantes</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// CATÁLOGO DE IMPLANTES E CIBERNÉTICOS</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Gerencie e consulte especificações de próteses, modificações corporais e hardware militar.</p>
        </div>

        <?php if (isset($erro_db)): ?>
            <div style="background: rgba(255, 0, 85, 0.1); border: 1px solid var(--neon-pink, #ff0055); padding: 12px; margin-bottom: 25px; color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace;">
                [ ERRO NO POSTGRESQL: <?= htmlspecialchars($erro_db) ?> ]
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO DE CADASTRO (CREATE) -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; margin-bottom: 40px; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                // POSTAR UM NOVO IMPLANTE
            </div>

            <form action="salvar_implante.php" method="POST">
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    
                    <div style="flex: 2; min-width: 250px;">
                        <label for="nome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Nome do Implante:</label><br>
                        <input type="text" id="nome" name="nome" placeholder="Ex: Lâminas de Louva-a-deus" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 220px;">
                        <label for="tipo" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Categoria / Tipo:</label><br>
                        <select id="tipo" name="tipo" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="">Selecione...</option>
                            <option value="SISTEMA NERVOSO">Sistema Nervoso</option>
                            <option value="SISTEMA OCULAR">Sistema Ocular</option>
                            <option value="SISTEMA CIRCULATÓRIO">Sistema Circulatório</option>
                            <option value="MEMBROS">Membros</option>
                            <option value="PELE / ARMADURA">Pele / Armadura Subcutânea</option>
                        </select>
                    </div>

                    <div style="flex: 1; min-width: 180px;">
                        <label for="preco" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Preço (Edis €$):</label><br>
                        <input type="number" step="0.01" id="preco" name="preco" placeholder="Ex: 15000.00" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                </div>

                <div style="margin-top: 15px;">
                    <label for="descricao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Descrição Técnica:</label><br>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Especificações técnicas e requisitos..." style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px; resize: vertical;"></textarea>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" style="background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 10px 20px; font-family: 'Share Tech Mono', monospace; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.2s;">
                        REGISTRAR IMPLANTE
                    </button>
                </div>
            </form>
        </div>

        <!-- LISTAGEM DO CATÁLOGO -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2 style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; margin: 0;">// CATÁLOGO DE IMPLANTES CADASTRADOS</h2>
            <span style="color: var(--text-dim, #8b949e); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Total: <?= count($implantes) ?> itens</span>
        </div>

        <div style="overflow-x: auto; background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <table style="width: 100%; border-collapse: collapse; font-family: 'Share Tech Mono', monospace; font-size: 0.95em;">
                <thead>
                    <tr style="background: #111827; color: var(--neon-cyan, #00ffcc); text-align: left;">
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">#ID</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">NOME DO IMPLANTE</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">CATEGORIA</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">PREÇO (€$)</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a);">ESPECIFICAÇÕES</th>
                        <th style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); text-align: center;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($implantes)): ?>
                        <?php foreach ($implantes as $item): ?>
                            <tr style="transition: background 0.2s;" onmouseover="this.style.background='var(--bg-panel-hover, #131b2c)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-dim, #8b949e);"><?= htmlspecialchars($item['id'] ?? '') ?></td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: #fff;">
                                    <strong><?= htmlspecialchars($item['nome'] ?? '') ?></strong>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-yellow, #fcee0a);">
                                    <?= htmlspecialchars($item['tipo'] ?? '') ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--neon-cyan, #00ffcc); font-weight: bold;">
                                    €$ <?= number_format($item['preco'] ?? 0, 2, ',', '.') ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); color: var(--text-main, #c9d1d9); font-size: 0.9em; max-width: 300px;">
                                    <?= htmlspecialchars($item['descricao'] ?? '') ?>
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid var(--border-cyber, #1f304a); text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="editar_implante.php?id=<?= $item['id'] ?>" style="background: #1f6feb; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Editar</a>
                                        <a href="excluir_implante.php?id=<?= $item['id'] ?>" onclick="return confirm('Excluir este registro permanentemente?')" style="background: #d73a49; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center; color: var(--text-dim, #8b949e);">
                                Nenhum implante registrado na base de dados.
                            </td>
                        </tr>
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