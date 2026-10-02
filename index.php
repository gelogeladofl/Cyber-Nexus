<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Terminal Central</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- O include do header já abre a tag <main class="container"> se atualizado, 
         mas caso o seu header.php não tenha a tag <main>, mantemos a classe container abaixo -->
    
    <div class="card">
        <div>
            ● TRANSMISSÃO ATIVA // TERMINAL DE DADOS #01
        </div>
        <h1>BEM-VINDO AO CYBER NEXUS</h1>
        <p>
            O Cyber Nexus é um ecossistema construído por fãs e para fãs. Nosso objetivo é 
            centralizar tudo sobre o universo Cyberpunk em um único ponto de acesso: de guias 
            detalhados de missões e catálogos de cibernéticos até arquivos confidenciais 
            sobre agentes, facções e a história deste mundo.
        </p>
    </div>

    <!-- CARDS DE ATALHOS RÁPIDOS PARA OS MÓDULOS DO SISTEMA -->
    <div>
        
        <div class="card">
            <h3>IMPLANTES</h3>
            <p>
                Gerenciamento e catálogo de próteses e cibernéticos.
            </p>
            <a href="/app/implantes/index.php" class="btn btn-primary">ACESSAR MÓDULO</a>
        </div>

        <div class="card">
            <h3>MISSÕES</h3>
            <p>
                Contratos, recompensas e objetivos táticos.
            </p>
            <a href="/app/missao/index.php" class="btn btn-primary">ACESSAR MÓDULO</a>
        </div>

        <div class="card">
            <h3>AGENTES</h3>
            <p>
                Ficha de operacionais, netrunners e fixers.
            </p>
            <a href="/agentes.php" class="btn btn-primary">ACESSAR MÓDULO</a>
        </div>

    </div>

    <!-- SEÇÃO SOBRE O UNIVERSO (CARD TÁTICO) -->
    <section class="card">
        <h2>O UNIVERSO CYBERPUNK: ALTA TECNOLOGIA, BAIXA QUALIDADE DE VIDA</h2>

        <p>
            Imagine um futuro onde o progresso tecnológico alcançou o ápice, mas a humanidade 
            ficou para trás. Em megalópoles sufocadas por luzes de neon e fumaça tóxica, gigantes 
            corporativos (Megacorps) substituíram governos e ditam as regras da sociedade, 
            transformando a vida humana em apenas mais uma mercadoria.
        </p>

        <p>
            Nesta realidade, a carne é fraca e superada. A modificação corporal deixou de ser um 
            luxo para se tornar uma necessidade de sobrevivência: ciber-olhos, lâminas retráteis, 
            processadores neurais e implantes militares estão ao alcance de qualquer um disposto 
            a pagar o preço — seja em edis ou com a própria sanidade, sob o constante risco da ciberpsicose.
        </p>

        <p>
            Abaixo do brilho dos arranha-céus das corporações, as ruas pertencem aos marginalizados. 
            Mercenários, netrunners, gangues implacáveis e corretores operam nas sombras da rede e dos 
            becos, disputando territórios, segredos e contratos letais. É um mundo de contraste brutal: 
            a riqueza inimaginável no topo, e a luta feroz pela sobrevivência no asfalto.
        </p>
    </section>

    <!-- SEÇÃO SOBRE O PROJETO -->
    <section class="card">
        <h2>SOBRE O PROJETO</h2>

        <p>
            O Cyber Nexus é uma base de dados viva. Como um terminal em constante atualização, 
            novos arquivos, bancos de dados, mapas e análises de equipamentos estão sendo 
            processados e compilados regularmente.
        </p>

        <p>
            &gt; Mantenha seu terminal conectado: a transmissão está apenas começando.
        </p>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>