<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../database/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM agentes WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $agente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$agente) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    die("Erro ao carregar ficha do agente: " . htmlspecialchars($e->getMessage()));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Editar Agente</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// EDITAR FICHA DE AGENTE</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Atualização de dados cadastrais do operacional #<?= htmlspecialchars($agente['id']) ?></p>
        </div>

        <!-- FORMULÁRIO DE EDIÇÃO -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 30px; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                // ATUALIZAR REGISTRO TÁTICO
            </div>

            <form action="salvar_agente.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($agente['id']) ?>">

                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    
                    <div style="flex: 1; min-width: 250px; margin-bottom: 15px;">
                        <label for="nome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Nome Real:</label><br>
                        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($agente['nome']) ?>" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 250px; margin-bottom: 15px;">
                        <label for="codinome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Codinome / Alcunha:</label><br>
                        <input type="text" id="codinome" name="codinome" value="<?= htmlspecialchars($agente['codinome']) ?>" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 180px; margin-bottom: 15px;">
                        <label for="funcao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Função:</label><br>
                        <select id="funcao" name="funcao" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Fixer" <?= $agente['funcao'] === 'Fixer' ? 'selected' : '' ?>>Fixer</option>
                            <option value="Mercenário" <?= $agente['funcao'] === 'Mercenário' ? 'selected' : '' ?>>Mercenário</option>
                            <option value="Netrunner" <?= $agente['funcao'] === 'Netrunner' ? 'selected' : '' ?>>Netrunner</option>
                            <option value="Techie" <?= $agente['funcao'] === 'Techie' ? 'selected' : '' ?>>Techie</option>
                            <option value="Solo" <?= $agente['funcao'] === 'Solo' ? 'selected' : '' ?>>Solo</option>
                        </select>
                    </div>

                </div>

                <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;">
                    
                    <div style="flex: 2; min-width: 250px; margin-bottom: 15px;">
                        <label for="distrito" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Distrito de Atuação:</label><br>
                        <input type="text" id="distrito" name="distrito" value="<?= htmlspecialchars($agente['distrito']) ?>" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 180px; margin-bottom: 15px;">
                        <label for="reputacao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Reputação:</label><br>
                        <select id="reputacao" name="reputacao" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Baixa" <?= $agente['reputacao'] === 'Baixa' ? 'selected' : '' ?>>Baixa</option>
                            <option value="Média" <?= $agente['reputacao'] === 'Média' ? 'selected' : '' ?>>Média</option>
                            <option value="Alta" <?= $agente['reputacao'] === 'Alta' ? 'selected' : '' ?>>Alta</option>
                            <option value="Lenda" <?= $agente['reputacao'] === 'Lenda' ? 'selected' : '' ?>>Lenda de Night City</option>
                        </select>
                    </div>

                    <div style="flex: 1; min-width: 180px; margin-bottom: 15px;">
                        <label for="status" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Status Operacional:</label><br>
                        <select id="status" name="status" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                            <option value="Ativo" <?= $agente['status'] === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="Desaparecido" <?= $agente['status'] === 'Desaparecido' ? 'selected' : '' ?>>Desaparecido</option>
                            <option value="Morto" <?= $agente['status'] === 'Morto' ? 'selected' : '' ?>>Morto</option>
                        </select>
                    </div>

                </div>

                <div style="margin-bottom: 25px; margin-top: 10px;">
                    <label for="biografia" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Biografia / Histórico:</label><br>
                    <textarea id="biografia" name="biografia" rows="5" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px; resize: vertical;"><?= htmlspecialchars(html_entity_decode($agente['biografia'], ENT_QUOTES, 'UTF-8')) ?></textarea>
                </div>

                <div style="display: flex; gap: 15px; align-items: center;">
                    <button type="submit" style="background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 10px 20px; font-family: 'Share Tech Mono', monospace; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.2s;">
                        SALVAR ALTERAÇÕES
                    </button>
                    <a href="index.php" style="color: var(--text-dim, #8b949e); text-decoration: none; font-family: 'Share Tech Mono', monospace; font-size: 0.95em;">[ Cancelar ]</a>
                </div>
            </form>
        </div>

    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>