<?php
require_once __DIR__ . '/../../database/conexao.php';

// Busca todos os agentes cadastrados
$query = $pdo->query("SELECT * FROM agentes ORDER BY criado_em DESC");
$agentes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Registro de Agentes</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h1>Agentes da Rede — Fixers & Mercenários</h1>
            <p>Cadastre e gerencie o perfil dos operantes ativos em Night City.</p>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'sucesso'): ?>
                <p style="color: #00ffcc; font-weight: bold;">Operação realizada com sucesso!</p>
            <?php endif; ?>

            <!-- FORMULÁRIO DE CADASTRO -->
            <fieldset style="margin-bottom: 20px; padding: 15px;">
                <legend><strong>Registrar Novo Agente</strong></legend>
                <form action="salvar_agente.php" method="POST">
                    <div style="margin-bottom: 10px;">
                        <label for="nome">Nome Real:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="codinome">Codinome / Alcunha:</label><br>
                        <input type="text" id="codinome" name="codinome" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="funcao">Função:</label><br>
                        <select id="funcao" name="funcao" required>
                            <option value="Fixer">Fixer</option>
                            <option value="Mercenário">Mercenário</option>
                            <option value="Netrunner">Netrunner</option>
                            <option value="Techie">Techie</option>
                            <option value="Solo">Solo</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="distrito">Distrito de Atuação:</label><br>
                        <input type="text" id="distrito" name="distrito" required placeholder="Ex: Watson, Heywood, Pacífica" style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="reputacao">Reputação:</label><br>
                        <select id="reputacao" name="reputacao" required>
                            <option value="Baixa">Baixa</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                            <option value="Lenda">Lenda de Night City</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="status">Status:</label><br>
                        <select id="status" name="status" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Desaparecido">Desaparecido</option>
                            <option value="Morto">Morto</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="biografia">Biografia / Histórico:</label><br>
                        <textarea id="biografia" name="biografia" rows="4" required style="width: 100%; max-width: 500px;"></textarea>
                    </div>

                    <button type="submit">Cadastrar Agente</button>
                </form>
            </fieldset>

            <hr>

            <h2>Agentes Registrados</h2>

            <table border="1" cellpadding="8" cellspacing="0" width="100%">
                <thead>
                    <tr>
                       
                        <th>Codinome</th>
                        <th>Nome Real</th>
                        <th>Função</th>
                        <th>Distrito</th>
                        <th>Reputação</th>
                        <th>Status</th>
                        <th>Biografia</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($agentes)): ?>
                        <tr>
                            <td colspan="9" align="center">Nenhum agente cadastrado no banco de dados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($agentes as $agente): ?>
                            <tr>
                                
                                <td><strong><?= htmlspecialchars($agente['codinome']) ?></strong></td>
                                <td><?= htmlspecialchars($agente['nome']) ?></td>
                                <td><?= htmlspecialchars($agente['funcao']) ?></td>
                                <td><?= htmlspecialchars($agente['distrito']) ?></td>
                                <td><?= htmlspecialchars($agente['reputacao']) ?></td>
                                <td><?= htmlspecialchars($agente['status']) ?></td>
                                <td><?= htmlspecialchars(html_entity_decode($agente['biografia'], ENT_QUOTES, 'UTF-8')) ?></td>
                                <td align="center">
                                    <a href="editar_agente.php?id=<?= $agente['id'] ?>">Editar</a> | 
                                    <a href="excluir_agente.php?id=<?= $agente['id'] ?>" onclick="return confirm('Tem certeza que deseja remover este agente?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>