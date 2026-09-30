<?php
require_once __DIR__ . '/../../database/conexao.php';

$missoes = [];

try {
    $stmt = $pdo->query("SELECT * FROM missoes ORDER BY id DESC");
    $missoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Missões e Contratos</title>
</head>
<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h2>Cadastrar Novo Contrato</h2>
            <form action="salvar_missao.php" method="POST">
                <div>
                    <label for="nome">Título da Missão:</label><br>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Resgate no Distrito Kabuki" required>
                </div>

                <br>

                <div>
                    <label for="dificuldade">Dificuldade:</label><br>
                    <select id="dificuldade" name="dificuldade" required>
                        <option value="">Selecione...</option>
                        <option value="Baixa">Baixa</option>
                        <option value="Média">Média</option>
                        <option value="Alta">Alta</option>
                        <option value="Extrema">Extrema</option>
                    </select>
                </div>

                <br>

                <div>
                    <label for="recompensa">Recompensa (€$):</label><br>
                    <input type="number" step="0.01" id="recompensa" name="recompensa" placeholder="Ex: 25000.00" required>
                </div>

                <br>

                <div>
                    <label for="status">Status do Contrato:</label><br>
                    <select id="status" name="status" required>
                        <option value="Pendente">Pendente</option>
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Concluída">Concluída</option>
                        <option value="Falhou">Falhou</option>
                    </select>
                </div>

                <br>

                <div>
                    <label for="descricao">Briefing / Detalhes da Missão:</label><br>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Informe os objetivos primários e secundários..."></textarea>
                </div>

                <br>

                <button type="submit">Publicar Missão</button>
            </form>
        </section>

        <hr>

        <section>
            <h2>Mural de Missões Ativas</h2>

            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Dificuldade</th>
                        <th>Recompensa (€$)</th>
                        <th>Status</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($missoes)): ?>
                        <?php foreach ($missoes as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                                <td><strong><?= htmlspecialchars($item['nome'] ?? '') ?></strong></td>
                                <td><?= htmlspecialchars($item['dificuldade'] ?? '') ?></td>
                                <td>€$ <?= number_format($item['recompensa'] ?? 0, 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item['status'] ?? '') ?></td>
                                <td><?= htmlspecialchars($item['descricao'] ?? '') ?></td>
                                <td>
                                    <a href="editar_missao.php?id=<?= $item['id'] ?>">Editar</a> | 
                                    <a href="excluir_missao.php?id=<?= $item['id'] ?>" onclick="return confirm('Cancelar este contrato permanentemente?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Nenhuma missão cadastrada no mural.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>