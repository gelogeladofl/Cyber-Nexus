<?php
// Verifica sessão se necessário
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Portal de Missões</title>
</head>
<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
        
        <!-- CABEÇALHO DO MÓDULO -->
        <div style="margin-bottom: 30px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">// PORTAL DE MISSÕES E CONTRATOS</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Selecione o terminal para acessar as operações de Night City.</p>
        </div>

        <!-- SEÇÃO DOS CARDS -->
        <section style="display: flex; gap: 25px; flex-wrap: wrap;">
            
            <!-- CARD 1: MURAL DA COMUNIDADE -->
            <div style="flex: 1; min-width: 300px; background: var(--bg-panel, #0d121d); border: 1px solid var(--neon-cyan, #00ffcc); padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 0 10px rgba(0, 255, 204, 0.05);">
                <div>
                    <h2 style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 1.2em; margin-top: 0;">
                        MURAL DA COMUNIDADE
                    </h2>
                    <p style="color: var(--text-main, #c9d1d9); line-height: 1.5; font-size: 0.95em;">
                        Crie, edite e compartilhe ideias de contratos, ganchos para mesas de RPG ou novos projetos táticos.
                    </p>
                </div>
                <div style="margin-top: 20px;">
                    <a href="/app/missao/mural.php" style="display: inline-block; width: 100%; text-align: center; box-sizing: border-box; background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 10px; text-decoration: none; font-family: 'Share Tech Mono', monospace; font-weight: bold; transition: 0.2s;">
                        ACESSAR MURAL DE IDEIAS →
                    </a>
                </div>
            </div>

            <!-- CARD 2: TODAS AS MISSÕES DO JOGO -->
            <div style="flex: 1; min-width: 300px; background: var(--bg-panel, #0d121d); border: 1px solid var(--neon-yellow, #fcee0a); padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 0 10px rgba(252, 238, 10, 0.05);">
                <div>
                    <h2 style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; font-size: 1.2em; margin-top: 0;">
                        ARQUIVO OFICIAL (2077)
                    </h2>
                    <p style="color: var(--text-main, #c9d1d9); line-height: 1.5; font-size: 0.95em;">
                        Guia completo com missões principais, serviços de fixers, cyberpsicopatas e espaço para comentários táticos.
                    </p>
                </div>
                <div style="margin-top: 20px;">
                    <a href="/app/missao/jogo.php" style="display: inline-block; width: 100%; text-align: center; box-sizing: border-box; background: transparent; border: 1px solid var(--neon-yellow, #fcee0a); color: var(--neon-yellow, #fcee0a); padding: 10px; text-decoration: none; font-family: 'Share Tech Mono', monospace; font-weight: bold; transition: 0.2s;">
                        EXPLORAR MISSÕES DO JOGO →
                    </a>
                </div>
            </div>

        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>