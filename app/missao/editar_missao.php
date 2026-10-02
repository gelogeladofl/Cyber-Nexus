<?php
require_once __DIR__ . '/../../database/conexao.php';

// Captura o ID da URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: mural.php');
    exit;
}

// Busca a missão correspondente no PostgreSQL
$stmt = $pdo->prepare("SELECT * FROM missoes WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$missao = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar o registro, redireciona
if (!$missao) {
    header('Location: mural.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Editar Missão</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h1>Editar Contrato #<?= $missao['id'] ?></h1>
            <p>Altere as especificações da missão e salve as atualizações na rede.</p>

            <fieldset style="margin-bottom: 20px; padding: 15px;">
                <legend><strong>Formulário de Edição</strong></legend>

                <form action="salvar_missao.php" method="POST">
                    <!-- Campo Oculto (Hidden) indispensável para enviar o ID na atualização -->
                    <input type="hidden" name="id" value="<?= $missao['id'] ?>">

                    <div style="margin-bottom: 10px;">
                        <label for="nome">Título da Missão:</label><br>
                        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($missao['nome']) ?>" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="dificuldade">Dificuldade:</label><br>
                        <select id="dificuldade" name="dificuldade" required>
                            <option value="Baixa" <?= $missao['dificuldade'] === 'Baixa' ? 'selected' : '' ?>>Baixa</option>
                            <option value="Média" <?= $missao['dificuldade'] === 'Média' ? 'selected' : '' ?>>Média</option>
                            <option value="Alta" <?= $missao['dificuldade'] === 'Alta' ? 'selected' : '' ?>>Alta</option>
                            <option value="Extrema" <?= $missao['dificuldade'] === 'Extrema' ? 'selected' : '' ?>>Extrema</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="recompensa">Recompensa (€$):</label><br>
                        <input type="number" step="0.01" id="recompensa" name="recompensa" value="<?= htmlspecialchars($missao['recompensa']) ?>" required>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="status">Status:</label><br>
                        <select id="status" name="status" required>
                            <option value="Pendente" <?= $missao['status'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                            <option value="Em Andamento" <?= $missao['status'] === 'Em Andamento' ? 'selected' : '' ?>>Em Andamento</option>
                            <option value="Concluída" <?= $missao['status'] === 'Concluída' ? 'selected' : '' ?>>Concluída</option>
                            <option value="Falhou" <?= $missao['status'] === 'Falhou' ? 'selected' : '' ?>>Falhou</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="descricao">Briefing / Descrição Detalhada:</label><br>
                        <textarea id="descricao" name="descricao" rows="4" required style="width: 100%; max-width: 500px;"><?= htmlspecialchars(html_entity_decode($missao['descricao'], ENT_QUOTES, 'UTF-8')) ?></textarea>
                    </div>

                    <button type="submit">Salvar Alterações</button>
                    <a href="mural.php" style="margin-left: 10px;">Cancelar</a>
                </form>
            </fieldset>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>