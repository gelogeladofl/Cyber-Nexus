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
    $stmt = $pdo->query("SELECT id, nome, apelido, email, nivel_acesso, criado_em FROM usuarios ORDER BY id ASC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $usuarios = [];
    $erro_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cyber Nexus — Gerenciamento de Usuários</title>
</head>
<body style="background-color: #0d1117; color: #c9d1d9; font-family: Arial, sans-serif; margin: 0; padding: 20px;">

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 900px; margin: 30px auto; padding: 20px; background: #161b22; border: 1px solid #30363d; border-radius: 6px;">
        <h2 style="color: #00ffcc; border-bottom: 1px solid #30363d; padding-bottom: 10px;">[ GERENCIAMENTO DE OPERADORES DA REDE ]</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'atualizado'): ?>
            <p style="color: #00ffcc; font-weight: bold;">Nível de acesso alterado com sucesso!</p>
        <?php endif; ?>

        <?php if (isset($erro_db)): ?>
            <p style="color: #ff0055;">Erro ao carregar usuários: <?= htmlspecialchars($erro_db) ?></p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: #21262d; color: #8b949e; text-align: left;">
                        <th style="padding: 10px; border: 1px solid #30363d;">ID</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Nome / Apelido</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">E-mail</th>
                        <th style="padding: 10px; border: 1px solid #30363d;">Nível Atual</th>
                        <th style="padding: 10px; border: 1px solid #30363d; text-align: center;">Ações (Mudar Nível)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #30363d;"><?= $u['id'] ?></td>
                            <td style="padding: 10px; border: 1px solid #30363d;">
                                <strong><?= htmlspecialchars($u['nome']) ?></strong><br>
                                <span style="color: #8b949e; font-size: 0.9em;">@<?= htmlspecialchars($u['apelido']) ?></span>
                            </td>
                            <td style="padding: 10px; border: 1px solid #30363d;"><?= htmlspecialchars($u['email']) ?></td>
                            <td style="padding: 10px; border: 1px solid #30363d;">
                                <span style="color: <?= $u['nivel_acesso'] === 'Admin' ? '#ff0055' : '#00ffcc' ?>; font-weight: bold;">
                                    <?= htmlspecialchars($u['nivel_acesso']) ?>
                                </span>
                            </td>
                            <td style="padding: 10px; border: 1px solid #30363d; text-align: center;">
                                <form action="alterar_nivel.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="usuario_id" value="<?= $u['id'] ?>">
                                    
                                    <?php if ($u['nivel_acesso'] === 'Admin'): ?>
                                        <input type="hidden" name="novo_nivel" value="Operador">
                                        <button type="submit" style="background: #d73a49; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px;">Rebaixar a Operador</button>
                                    <?php else: ?>
                                        <input type="hidden" name="novo_nivel" value="Admin">
                                        <button type="submit" style="background: #238636; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px;">Promover a Admin</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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