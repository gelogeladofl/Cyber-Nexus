<?php
require_once __DIR__ . '/../../database/conexao.php';

// Bloqueia o acesso de quem não é Admin
if (!isset($_SESSION['usuario_nivel']) || $_SESSION['usuario_nivel'] !== 'Admin') {
    header('Location: ../../index.php?erro=acesso_negado');
    exit;
}

// Busca contadores para as métricas do painel
$totalUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$totalMissoes  = $pdo->query("SELECT COUNT(*) FROM missoes")->fetchColumn();
$totalAgentes  = $pdo->query("SELECT COUNT(*) FROM agentes")->fetchColumn();
$totalImplantes= $pdo->query("SELECT COUNT(*) FROM implantes")->fetchColumn();
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

    <main>
        <section>
            <h1>Painel de Controle Central — Admin</h1>
            <p>Bem-vindo, <strong><?= htmlspecialchars($_SESSION['usuario_apelido'] ?? 'Admin') ?></strong>. Status do sistema: <span style="color: #00ffcc;">OPERACIONAL</span>.</p>

            <!-- MÉTRICAS DO SISTEMA -->
            <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 30px;">
                <div style="border: 1px solid #ccc; padding: 15px; flex: 1; min-width: 150px;">
                    <h3>Usuários</h3>
                    <p style="font-size: 1.8rem; margin: 5px 0;"><strong><?= $totalUsuarios ?></strong></p>
                    <a href="usuarios.php">Gerenciar Contas</a>
                </div>

                <div style="border: 1px solid #ccc; padding: 15px; flex: 1; min-width: 150px;">
                    <h3>Mural de Missões</h3>
                    <p style="font-size: 1.8rem; margin: 5px 0;"><strong><?= $totalMissoes ?></strong></p>
                    <a href="../missoes/mural.php">Acessar Mural</a>
                </div>

                <div style="border: 1px solid #ccc; padding: 15px; flex: 1; min-width: 150px;">
                    <h3>Agentes</h3>
                    <p style="font-size: 1.8rem; margin: 5px 0;"><strong><?= $totalAgentes ?></strong></p>
                    <a href="../agentes/mural.php">Acessar Agentes</a>
                </div>

                <div style="border: 1px solid #ccc; padding: 15px; flex: 1; min-width: 150px;">
                    <h3>Implantes</h3>
                    <p style="font-size: 1.8rem; margin: 5px 0;"><strong><?= $totalImplantes ?></strong></p>
                    <a href="../implantes/index.php">Acessar Implantes</a>
                </div>
            </div>

            <!-- ATALHOS RÁPIDOS -->
            <fieldset style="padding: 15px;">
                <legend><strong>Ferramentas do Administrador</strong></legend>
                <ul>
                    <li><a href="usuarios.php">Gerenciar e Alterar Níveis de Acesso de Usuários</a></li>
                    <li><a href="../missoes/mural.php">Moderar Contratos e Ideias no Mural</a></li>
                    <li><a href="../agentes/mural.php">Gerenciar Fichas de Agentes</a></li>
                </ul>
            </fieldset>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>