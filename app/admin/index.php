<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../database/conexao.php';

// Proteção de Acesso: Libera apenas se for Admin
if (!isset($_SESSION['usuario_nivel']) || strcasecmp(trim($_SESSION['usuario_nivel']), 'Admin') !== 0) {
    header('Location: ../../index.php?erro=acesso_negado');
    exit;
}

// Busca contadores para as métricas do painel
try {
    $totalUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    $totalMissoes  = $pdo->query("SELECT COUNT(*) FROM missoes")->fetchColumn();
    $totalAgentes  = $pdo->query("SELECT COUNT(*) FROM agentes")->fetchColumn();
    $totalImplantes= $pdo->query("SELECT COUNT(*) FROM implantes")->fetchColumn();
} catch (PDOException $e) {
    $totalUsuarios = $totalMissoes = $totalAgentes = $totalImplantes = 0;
    $erro_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Painel do Administrador</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO PAINEL -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-pink, #ff0055); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// PAINEL DE CONTROLE CENTRAL — ADMIN</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">
                Bem-vindo, <strong style="color: var(--neon-cyan, #00ffcc);"><?= htmlspecialchars($_SESSION['usuario_apelido'] ?? 'Admin') ?></strong>. Status do sistema: <span style="color: var(--neon-cyan, #00ffcc); font-weight: bold;">[ OPERACIONAL ]</span>
            </p>
        </div>

        <?php if (isset($erro_db)): ?>
            <div style="background: rgba(255, 0, 85, 0.1); border: 1px solid var(--neon-pink, #ff0055); padding: 12px; margin-bottom: 25px; color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace;">
                [ ERRO NA LEITURA DE MÉTRICAS: <?= htmlspecialchars($erro_db) ?> ]
            </div>
        <?php endif; ?>

        <!-- MÉTRICAS DO SISTEMA -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 35px;">
            
            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <h3 style="color: var(--neon-cyan, #00ffcc); margin: 0; font-family: 'Share Tech Mono', monospace; font-size: 1.1em;">USUÁRIOS</h3>
                <p style="font-size: 2.2rem; margin: 10px 0; color: #fff; font-weight: bold; font-family: 'Share Tech Mono', monospace;"><?= $totalUsuarios ?></p>
                <a href="usuarios.php" style="color: var(--neon-cyan, #00ffcc); text-decoration: none; font-size: 0.85em; font-family: 'Share Tech Mono', monospace; border-bottom: 1px dotted var(--neon-cyan, #00ffcc);">[ Gerenciar Contas ]</a>
            </div>

            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <h3 style="color: var(--neon-yellow, #fcee0a); margin: 0; font-family: 'Share Tech Mono', monospace; font-size: 1.1em;">MURAL DE MISSÕES</h3>
                <p style="font-size: 2.2rem; margin: 10px 0; color: #fff; font-weight: bold; font-family: 'Share Tech Mono', monospace;"><?= $totalMissoes ?></p>
                <a href="moderar_missoes.php" style="color: var(--neon-yellow, #fcee0a); text-decoration: none; font-size: 0.85em; font-family: 'Share Tech Mono', monospace; border-bottom: 1px dotted var(--neon-yellow, #fcee0a);">[ Moderar Mural ]</a>
            </div>

            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <h3 style="color: var(--neon-cyan, #00ffcc); margin: 0; font-family: 'Share Tech Mono', monospace; font-size: 1.1em;">AGENTES</h3>
                <p style="font-size: 2.2rem; margin: 10px 0; color: #fff; font-weight: bold; font-family: 'Share Tech Mono', monospace;"><?= $totalAgentes ?></p>
                <a href="moderar_agentes.php" style="color: var(--neon-cyan, #00ffcc); text-decoration: none; font-size: 0.85em; font-family: 'Share Tech Mono', monospace; border-bottom: 1px dotted var(--neon-cyan, #00ffcc);">[ Moderar Agentes ]</a>
            </div>

            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <h3 style="color: var(--neon-pink, #ff0055); margin: 0; font-family: 'Share Tech Mono', monospace; font-size: 1.1em;">IMPLANTES</h3>
                <p style="font-size: 2.2rem; margin: 10px 0; color: #fff; font-weight: bold; font-family: 'Share Tech Mono', monospace;"><?= $totalImplantes ?></p>
                <a href="moderar_implantes.php" style="color: var(--neon-pink, #ff0055); text-decoration: none; font-size: 0.85em; font-family: 'Share Tech Mono', monospace; border-bottom: 1px dotted var(--neon-pink, #ff0055);">[ Moderar Catálogo ]</a>
            </div>

        </div>

        <!-- FERRAMENTAS DO ADMINISTRADOR -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 15px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                // FERRAMENTAS TÁTICAS DE MODERAÇÃO
            </div>

            <ul style="list-style: none; padding: 0; margin: 0; font-family: 'Share Tech Mono', monospace;">
                <li style="margin-bottom: 12px;">
                    <a href="usuarios.php" style="color: var(--text-main, #c9d1d9); text-decoration: none; display: inline-block; padding: 5px 0;">
                        <span style="color: var(--neon-cyan, #00ffcc);">&gt;</span> Gerenciar Operadores e Alterar Níveis de Acesso
                    </a>
                </li>
                <li style="margin-bottom: 12px;">
                    <a href="moderar_missoes.php" style="color: var(--text-main, #c9d1d9); text-decoration: none; display: inline-block; padding: 5px 0;">
                        <span style="color: var(--neon-yellow, #fcee0a);">&gt;</span> Moderar Contratos e Ideias no Mural
                    </a>
                </li>
                <li style="margin-bottom: 12px;">
                    <a href="moderar_agentes.php" style="color: var(--text-main, #c9d1d9); text-decoration: none; display: inline-block; padding: 5px 0;">
                        <span style="color: var(--neon-cyan, #00ffcc);">&gt;</span> Gerenciar Fichas de Agentes da Rede
                    </a>
                </li>
                <li>
                    <a href="" style="color: var(--text-main, #c9d1d9); text-decoration: none; display: inline-block; padding: 5px 0;">
                        <span style="color: var(--neon-pink, #ff0055);">&gt;</span> Gerenciar Catálogo de Implantes e Cibernéticos
                    </a>
                </li>
            </ul>
        </div>

    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>