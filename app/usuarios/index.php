<?php
session_start();
require_once __DIR__ . '/../../database/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Autenticação de Usuários</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section style="display: flex; gap: 40px; flex-wrap: wrap;">
            
            <!-- FORMULÁRIO DE LOGIN -->
            <fieldset style="flex: 1; min-width: 300px; padding: 20px;">
                <legend><strong>Acessar a Rede (Login)</strong></legend>
                <form action="login.php" method="POST">
                    <div style="margin-bottom: 10px;">
                        <label for="login_email">E-mail ou Apelido:</label><br>
                        <input type="text" id="login_email" name="login" required style="width: 100%;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="login_senha">Senha:</label><br>
                        <input type="password" id="login_senha" name="senha" required style="width: 100%;">
                    </div>

                    <button type="submit">Entrar na Rede</button>
                </form>
            </fieldset>

            <!-- FORMULÁRIO DE CADASTRO -->
            <fieldset style="flex: 1; min-width: 300px; padding: 20px;">
                <legend><strong>Novo Registro de Usuário</strong></legend>
                <form action="salvar_usuario.php" method="POST">
                    <div style="margin-bottom: 10px;">
                        <label for="nome">Nome Completo:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="apelido">Apelido de Rede (Codinome):</label><br>
                        <input type="text" id="apelido" name="apelido" required style="width: 100%;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="email" required style="width: 100%;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="senha">Senha:</label><br>
                        <input type="password" id="senha" name="senha" required style="width: 100%;">
                    </div>

                    <button type="submit">Cadastrar Usuário</button>
                </form>
            </fieldset>

        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>