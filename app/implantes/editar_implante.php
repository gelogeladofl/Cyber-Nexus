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
    $stmt = $pdo->prepare("SELECT * FROM implantes WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $implante = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$implante) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    die("Erro ao carregar implante: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Editar Implante</title>
</head>
<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// EDITAR REGISTRO DE IMPLANTE</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Modificação de especificações técnicas do item #<?= htmlspecialchars($implante['id']) ?></p>
        </div>

        <!-- FORMULÁRIO DE EDIÇÃO -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 30px; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                // ATUALIZAR ESPECIFICAÇÕES DO HARDWARE
            </div>

            <form action="salvar_implante.php" method="POST">
                
                <input type="hidden" name="id" value="<?= htmlspecialchars($implante['id']) ?>">

                <div style="margin-bottom: 20px;">
                    <label for="nome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Nome do Implante:</label><br>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($implante['nome']) ?>" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="tipo" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Categoria / Tipo:</label><br>
                    <select id="tipo" name="tipo" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                        <?php 
                        $categorias = [
                            'SISTEMA NERVOSO', 
                            'SISTEMA OCULAR', 
                            'SISTEMA CIRCULATÓRIO', 
                            'MEMBROS', 
                            'PELE / ARMADURA'
                        ];
                        foreach ($categorias as $cat): 
                            $selected = ($implante['tipo'] === $cat) ? 'selected' : '';
                        ?>
                            <option value="<?= $cat ?>" <?= $selected ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="preco" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Preço (Edis €$):</label><br>
                    <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($implante['preco']) ?>" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="descricao" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Descrição Técnica:</label><br>
                    <textarea id="descricao" name="descricao" rows="5" style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px; resize: vertical;"><?= htmlspecialchars($implante['descricao']) ?></textarea>
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