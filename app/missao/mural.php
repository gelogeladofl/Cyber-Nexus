<?php
require_once __DIR__ . '/../../database/conexao.php';

// Busca todas as missões da comunidade cadastradas
$query = $pdo->query("SELECT * FROM missoes ORDER BY criado_em DESC");
$missoesMural = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Mural da Comunidade</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h1>Mural da Comunidade — Ideias de Contratos</h1>
            <p>Cadastre suas próprias ideias de missões e compartilhe com a rede.</p>

            <!-- FORMULÁRIO DE CADASTRO (CREATE) -->
            <fieldset style="margin-bottom: 20px; padding: 15px;">
                <legend><strong>Postar Novo Contrato / Ideia</strong></legend>
                <form action="salvar_missao.php" method="POST">
                    <div style="margin-bottom: 10px;">
                        <label for="nome">Título da Missão:</label><br>
                        <input type="text" id="nome" name="nome" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="dificuldade">Dificuldade:</label><br>
                        <select id="dificuldade" name="dificuldade" required>
                            <option value="Baixa">Baixa</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                            <option value="Extrema">Extrema</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="recompensa">Recompensa (€$):</label><br>
                        <input type="number" step="0.01" id="recompensa" name="recompensa" required placeholder="0.00">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="status">Status:</label><br>
                        <select id="status" name="status" required>
                            <option value="Pendente">Pendente</option>
                            <option value="Em Andamento">Em Andamento</option>
                            <option value="Concluída">Concluída</option>
                            <option value="Falhou">Falhou</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="descricao">Briefing / Descrição Detalhada:</label><br>
                        <textarea id="descricao" name="descricao" rows="4" required style="width: 100%; max-width: 500px;"></textarea>
                    </div>

                    <button type="submit">Publicar no Mural</button>
                </form>
            </fieldset>

            <hr>

            <h2>Contratos Postados</h2>

            <table border="1" cellpadding="8" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Dificuldade</th>
                        <th>Recompensa</th>
                        <th>Status</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($missoesMural)): ?>
                        <tr>
                            <td colspan="7" align="center">Nenhuma ideia de missão cadastrada no mural ainda.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($missoesMural as $missao): ?>
                            <tr>
                                <td><?= $missao['id'] ?></td>
                                <td><strong><?= htmlspecialchars($missao['nome']) ?></strong></td>
                                <td><?= htmlspecialchars($missao['dificuldade']) ?></td>
                                <td>€$ <?= number_format($missao['recompensa'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($missao['status']) ?></td>
                                <td><?= htmlspecialchars(html_entity_decode($missao['descricao'], ENT_QUOTES, 'UTF-8')) ?></td>
                                <td align="center">
                                    <a href="editar_missao.php?id=<?= $missao['id'] ?>">Editar</a> |
                                    <a href="excluir_missao.php?id=<?= $missao['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta missão do mural?')">Excluir</a>
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