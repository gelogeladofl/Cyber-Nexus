<?php
require_once __DIR__ . '/../../database/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Autenticação</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
        
        <div style="margin-bottom: 25px; border-left: 3px solid var(--neon-cyan, #00ffcc); padding-left: 15px;">
            <h1 style="color: #fff; font-family: 'Share Tech Mono', monospace; margin: 0;">TERMINAL DE ACESSO À REDE</h1>
            <p style="color: var(--text-dim, #8b949e); margin: 5px 0 0 0;">Identifique-se para estabelecer conexão segura com o Cyber Nexus.</p>
        </div>

        <section style="display: flex; gap: 30px; flex-wrap: wrap;">
            
            <!-- FORMULÁRIO DE LOGIN -->
            <div style="flex: 1; min-width: 300px; background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; position: relative;">
                <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                    // ACESSAR A REDE (LOGIN)
                </div>
                
                <form action="login.php" method="POST">
                    <div style="margin-bottom: 15px;">
                        <label for="login" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">E-mail ou Apelido de Rede:</label><br>
                        <input type="text" id="login" name="login" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="login_senha" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Senha:</label><br>
                        <input type="password" id="login_senha" name="senha" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <button type="submit" style="width: 100%; background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 12px; font-family: 'Share Tech Mono', monospace; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.2s;">
                        ENTRAR NA REDE
                    </button>
                </form>
            </div>

            <!-- FORMULÁRIO DE NOVO CADASTRO -->
            <div style="flex: 1; min-width: 300px; background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; position: relative;">
                <div style="color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace; font-size: 1.1em; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid var(--border-cyber, #1f304a); padding-bottom: 10px;">
                    // NOVO REGISTRO DE OPERADOR
                </div>
                
                <form action="salvar_usuario.php" method="POST">
                    <div style="margin-bottom: 15px;">
                        <label for="nome" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Nome Completo:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="apelido" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Apelido de Rede (Codinome):</label><br>
                        <input type="text" id="apelido" name="apelido" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="email" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">E-mail:</label><br>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="senha" style="color: var(--text-main, #c9d1d9); font-family: 'Share Tech Mono', monospace; font-size: 0.9em;">Senha:</label><br>
                        <input type="password" id="senha" name="senha" required style="width: 100%; padding: 10px; background: var(--bg-deep, #080a0f); border: 1px solid var(--border-cyber, #1f304a); color: #fff; box-sizing: border-box; margin-top: 5px;">
                    </div>

                    <button type="submit" style="width: 100%; background: transparent; border: 1px solid var(--neon-pink, #ff0055); color: var(--neon-pink, #ff0055); padding: 12px; font-family: 'Share Tech Mono', monospace; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.2s;">
                        REGISTRAR OPERADOR
                    </button>
                </form>
            </div>

        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>