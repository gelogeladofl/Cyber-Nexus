<?php
session_start();
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

    <main>
        <section style="display: flex; gap: 30px; flex-wrap: wrap; margin-top: 20px;">
            
            <!-- FORMULÁRIO DE LOGIN -->
            <fieldset style="flex: 1; min-width: 300px; padding: 20px;">
                <legend><strong>Acessar a Rede (Login)</strong></legend>
                
                <form action="login.php" method="POST">
                    <div style="margin-bottom: 12px;">
                        <label for="login">E-mail ou Apelido de Rede:</label><br>
                        <input type="text" id="login" name="login" required style="width: 100%; padding: 8px;">
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label for="login_senha">Senha:</label><br>
                        <input type="password" id="login_senha" name="senha" required style="width: 100%; padding: 8px;">
                    </div>

                    <button type="submit" style="padding: 10px 20px;">Entrar</button>
                </form>
            </fieldset>

            <!-- FORMULÁRIO DE NOVO CADASTRO -->
            <fieldset style="flex: 1; min-width: 300px; padding: 20px;">
                <legend><strong>Novo Registro de Operador</strong></legend>
                
                <form action="salvar_usuario.php" method="POST">
                    <div style="margin-bottom: 12px;">
                        <label for="nome">Nome Completo:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%; padding: 8px;">
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label for="apelido">Apelido de Rede (Codinome):</label><br>
                        <input type="text" id="apelido" name="apelido" required style="width: 100%; padding: 8px;">
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;">
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label for="senha">Senha:</label><br>
                        <input type="password" id="senha" name="senha" required style="width: 100%; padding: 8px;">
                    </div>

                    <button type="submit" style="padding: 10px 20px;">Cadastrar</button>
                </form>
            </fieldset>

        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>