<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Portal de Missões</title>
</head>
<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h1> CYBER NEXUS </h1>
            <p>Selecione o terminal para acessar as operações de Night City:</p>
        </section>

        <hr>

        <section style="display: flex; gap: 20px;">
            <!-- CARD 1: MURAL DA COMUNIDADE -->
            <div style="border: 1px solid #00f0ff; padding: 20px; width: 50%;">
                <h2> Mural de ideas de Missões da Comunidade</h2>
                <p>Crie, edite e compartilhe ideias de contratos e ganchos para mesas de RPG ou novos projetos.</p>
                <a href="/app/missao/mural.php"><strong>Acessar Mural de Ideias →</strong></a>
            </div>

            <!-- CARD 2: TODAS AS MISSÕES DO JOGO -->
            <div style="border: 1px solid #ffe600; padding: 20px; width: 50%;">
                <h2> Arquivo Oficial de Missões (Cyberpunk 2077)</h2>
                <p>Guia completo com todas as missões principais, serviços de fixers, cyberpsicopatas e espaço para comentários.</p>
                <a href="/app/missao/jogo.php"><strong>Explorar Missões do Jogo →</strong></a>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>