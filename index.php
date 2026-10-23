<?php
require_once __DIR__ . '/database/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Terminal Central</title>
    <!-- Se você estiver usando o cyber_style.php direto no header, os estilos já vão carregar -->
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <main style="max-width: 1100px; margin: 30px auto; padding: 0 20px;">

        <!-- TRANSMISSÃO ATIVA -->
        <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; margin-bottom: 25px; position: relative; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
            <div style="color: var(--neon-cyan, #00ffcc); font-family: 'Share Tech Mono', monospace; font-size: 0.9em; margin-bottom: 10px;">
                ● TRANSMISSÃO ATIVA // TERMINAL DE DADOS #01
            </div>
            <h1 style="color: #fff; margin-top: 0; font-family: 'Share Tech Mono', monospace;">BEM-VINDO AO CYBER NEXUS</h1>
            <p style="line-height: 1.6; color: var(--text-main, #c9d1d9);">
                O Cyber Nexus é um ecossistema construído por fãs e para fãs. Nosso objetivo é 
                centralizar tudo sobre o universo Cyberpunk em um único ponto de acesso: de guias 
                detalhados de missões e catálogos de cibernéticos até arquivos confidenciais 
                sobre agentes, facções e a história deste mundo.
            </p>
        </div>

        <!-- CARDS DE ATALHOS RÁPIDOS (LADO A LADO) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 25px;">
            
            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3 style="color: var(--neon-cyan, #00ffcc); margin-top: 0;">IMPLANTES</h3>
                    <p style="color: var(--text-main, #c9d1d9); font-size: 0.95em;">
                        Gerenciamento e catálogo de próteses e cibernéticos.
                    </p>
                </div>
                <div style="margin-top: 15px;">
                    <a href="/cyber-nexus/app/implantes/index.php" style="display: inline-block; text-align: center; width: 100%; box-sizing: border-box; background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 8px 12px; text-decoration: none; font-family: 'Share Tech Mono', monospace; font-weight: bold; transition: 0.2s;">ACESSAR MÓDULO</a>
                </div>
            </div>

            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3 style="color: var(--neon-cyan, #00ffcc); margin-top: 0;">MISSÕES</h3>
                    <p style="color: var(--text-main, #c9d1d9); font-size: 0.95em;">
                        Contratos, recompensas e objetivos táticos.
                    </p>
                </div>
                <div style="margin-top: 15px;">
                    <a href="/cyber-nexus/app/missao/index.php" style="display: inline-block; text-align: center; width: 100%; box-sizing: border-box; background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 8px 12px; text-decoration: none; font-family: 'Share Tech Mono', monospace; font-weight: bold; transition: 0.2s;">ACESSAR MÓDULO</a>
                </div>
            </div>

            <div style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 20px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3 style="color: var(--neon-cyan, #00ffcc); margin-top: 0;">AGENTES</h3>
                    <p style="color: var(--text-main, #c9d1d9); font-size: 0.95em;">
                        Ficha de operacionais, netrunners e fixers.
                    </p>
                </div>
                <div style="margin-top: 15px;">
                    <a href="/cyber-nexus/app/agentes/index.php" style="display: inline-block; text-align: center; width: 100%; box-sizing: border-box; background: transparent; border: 1px solid var(--neon-cyan, #00ffcc); color: var(--neon-cyan, #00ffcc); padding: 8px 12px; text-decoration: none; font-family: 'Share Tech Mono', monospace; font-weight: bold; transition: 0.2s;">ACESSAR MÓDULO</a>
                </div>
            </div>

        </div>

        <!-- SEÇÃO SOBRE O UNIVERSO -->
        <section style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px; margin-bottom: 25px;">
            <h2 style="color: var(--neon-pink, #ff0055); font-family: 'Share Tech Mono', monospace; margin-top: 0;">O UNIVERSO CYBERPUNK: ALTA TECNOLOGIA, BAIXA QUALIDADE DE VIDA</h2>

            <p style="line-height: 1.6; color: var(--text-main, #c9d1d9);">
                Imagine um futuro onde o progresso tecnológico alcançou o ápice, mas a humanidade 
                ficou para trás. Em megalópoles sufocadas por luzes de neon e fumaça tóxica, gigantes 
                corporativos (Megacorps) substituíram governos e ditam as regras da sociedade, 
                transformando a vida humana em apenas mais uma mercadoria.
            </p>

            <p style="line-height: 1.6; color: var(--text-main, #c9d1d9);">
                Nesta realidade, a carne é fraca e superada. A modificação corporal deixou de ser um 
                luxo para se tornar uma necessidade de sobrevivência: ciber-olhos, lâminas retráteis, 
                processadores neurais e implantes militares estão ao alcance de qualquer um disposto 
                a pagar o preço — seja em edis ou com a própria sanidade, sob o constante risco da ciberpsicose.
            </p>

            <p style="line-height: 1.6; color: var(--text-main, #c9d1d9);">
                Abaixo do brilho dos arranha-céus das corporações, as ruas pertencem aos marginalizados. 
                Mercenários, netrunners, gangues implacáveis e corretores operam nas sombras da rede e dos 
                becos, disputando territórios, segredos e contratos letais. É um mundo de contraste brutal: 
                a riqueza inimaginável no topo, e a luta feroz pela sobrevivência no asfalto.
            </p>
        </section>

        <!-- SEÇÃO SOBRE O PROJETO -->
        <section style="background: var(--bg-panel, #0d121d); border: 1px solid var(--border-cyber, #1f304a); padding: 25px;">
            <h2 style="color: var(--neon-yellow, #fcee0a); font-family: 'Share Tech Mono', monospace; margin-top: 0;">SOBRE O PROJETO</h2>

            <p style="line-height: 1.6; color: var(--text-main, #c9d1d9);">
                O Cyber Nexus é uma base de dados viva. Como um terminal em constante atualização, 
                novos arquivos, bancos de dados, mapas e análises de equipamentos estão sendo 
                processados e compilados regularmente.
            </p>

            <p style="font-family: 'Share Tech Mono', monospace; color: var(--neon-cyan, #00ffcc); margin-bottom: 0;">
                &gt; Mantenha seu terminal conectado: a transmissão está apenas começando.
            </p>
        </section>

    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>