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
    
    <div class="card" style="margin-top: 1rem;">
        <div style="font-size: 0.8rem; color: var(--hud-green); margin-bottom: 0.5rem;">
            ● TRANSMISSÃO ATIVA // TERMINAL DE DADOS #01
        </div>
        <h1>BEM-VINDO AO CYBER NEXUS</h1>
        <p style="color: var(--text-primary); font-size: 1.05rem;">
            O Cyber Nexus é um ecossistema construído por fãs e para fãs. Nosso objetivo é 
            centralizar tudo sobre o universo Cyberpunk em um único ponto de acesso: de guias 
            detalhados de missões e catálogos de cibernéticos até arquivos confidenciais 
            sobre agentes, facções e a história deste mundo.
        </p>
    </div>

    <!-- CARDS DE ATALHOS RÁPIDOS PARA OS MÓDULOS DO SISTEMA -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        
        <div class="card" style="margin-bottom: 0;">
            <h3 style="color: var(--hud-cyan); font-size: 1.1rem;">IMPLANTES</h3>
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 1.2rem;">
                Gerenciamento e catálogo de próteses e cibernéticos.
            </p>
            <a href="/app/implantes/index.php" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">ACESSAR MÓDULO</a>
        </div>

        <div class="card" style="margin-bottom: 0;">
            <h3 style="color: var(--hud-amber); font-size: 1.1rem;">MISSÕES</h3>
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 1.2rem;">
                Contratos, recompensas e objetivos táticos.
            </p>
            <a href="/missoes.php" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">ACESSAR MÓDULO</a>
        </div>

        <div class="card" style="margin-bottom: 0;">
            <h3 style="color: var(--hud-green); font-size: 1.1rem;">AGENTES</h3>
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 1.2rem;">
                Ficha de operacionais, netrunners e fixers.
            </p>
            <a href="/agentes.php" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">ACESSAR MÓDULO</a>
        </div>

    </div>

    <!-- SEÇÃO SOBRE O UNIVERSO (CARD TÁTICO) -->
    <section class="card">
        <h2>O UNIVERSO CYBERPUNK: ALTA TECNOLOGIA, BAIXA QUALIDADE DE VIDA</h2>

        <p style="margin-bottom: 1rem;">
            Imagine um futuro onde o progresso tecnológico alcançou o ápice, mas a humanidade 
            ficou para trás. Em megalópoles sufocadas por luzes de neon e fumaça tóxica, gigantes 
            corporativos (Megacorps) substituíram governos e ditam as regras da sociedade, 
            transformando a vida humana em apenas mais uma mercadoria.
        </p>

        <p style="margin-bottom: 1rem;">
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
    <section class="card" style="border-left-color: var(--hud-amber);">
        <h2 style="color: var(--hud-amber);">SOBRE O PROJETO</h2>

        <p style="margin-bottom: 1rem;">
            O Cyber Nexus é uma base de dados viva. Como um terminal em constante atualização, 
            novos arquivos, bancos de dados, mapas e análises de equipamentos estão sendo 
            processados e compilados regularmente.
        </p>

        <p style="color: var(--hud-cyan); font-family: var(--font-code); font-weight: bold;">
            &gt; Mantenha seu terminal conectado: a transmissão está apenas começando.
        </p>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>