<?php
require_once __DIR__ . '/../../database/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: mural.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM agentes WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$agente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agente) {
    header('Location: mural.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Editar Agente</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h1>Editar Agente #<?= $agente['id'] ?></h1>

            <fieldset style="margin-bottom: 20px; padding: 15px;">
                <legend><strong>Alterar Registro</strong></legend>

                <form action="salvar_agente.php" method="POST">
                    <input type="hidden" name="id" value="<?= $agente['id'] ?>">

                    <div style="margin-bottom: 10px;">
                        <label for="nome">Nome Real:</label><br>
                        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($agente['nome']) ?>" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="codinome">Codinome / Alcunha:</label><br>
                        <input type="text" id="codinome" name="codinome" value="<?= htmlspecialchars($agente['codinome']) ?>" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="funcao">Função:</label><br>
                        <select id="funcao" name="funcao" required>
                            <option value="Fixer" <?= $agente['funcao'] === 'Fixer' ? 'selected' : '' ?>>Fixer</option>
                            <option value="Mercenário" <?= $agente['funcao'] === 'Mercenário' ? 'selected' : '' ?>>Mercenário</option>
                            <option value="Netrunner" <?= $agente['funcao'] === 'Netrunner' ? 'selected' : '' ?>>Netrunner</option>
                            <option value="Techie" <?= $agente['funcao'] === 'Techie' ? 'selected' : '' ?>>Techie</option>
                            <option value="Solo" <?= $agente['funcao'] === 'Solo' ? 'selected' : '' ?>>Solo</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="distrito">Distrito de Atuação:</label><br>
                        <input type="text" id="distrito" name="distrito" value="<?= htmlspecialchars($agente['distrito']) ?>" required style="width: 100%; max-width: 400px;">
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="reputacao">Reputação:</label><br>
                        <select id="reputacao" name="reputacao" required>
                            <option value="Baixa" <?= $agente['reputacao'] === 'Baixa' ? 'selected' : '' ?>>Baixa</option>
                            <option value="Média" <?= $agente['reputacao'] === 'Média' ? 'selected' : '' ?>>Média</option>
                            <option value="Alta" <?= $agente['reputacao'] === 'Alta' ? 'selected' : '' ?>>Alta</option>
                            <option value="Lenda" <?= $agente['reputacao'] === 'Lenda' ? 'selected' : '' ?>>Lenda de Night City</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="status">Status:</label><br>
                        <select id="status" name="status" required>
                            <option value="Ativo" <?= $agente['status'] === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="Desaparecido" <?= $agente['status'] === 'Desaparecido' ? 'selected' : '' ?>>Desaparecido</option>
                            <option value="Morto" <?= $agente['status'] === 'Morto' ? 'selected' : '' ?>>Morto</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="biografia">Biografia / Histórico:</label><br>
                        <textarea id="biografia" name="biografia" rows="4" required style="width: 100%; max-width: 500px;"><?= htmlspecialchars(html_entity_decode($agente['biografia'], ENT_QUOTES, 'UTF-8')) ?></textarea>
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