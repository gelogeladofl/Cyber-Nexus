<?php
require_once __DIR__ . '/../../database/conexao.php';

$implantes = [];

try {
    $stmt = $pdo->query("SELECT * FROM implantes ORDER BY id DESC");
    $implantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red; font-weight:bold;'>Erro no PostgreSQL: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Implantes</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <form action="salvar_implante.php" method="POST">
                <fieldset style="margin-bottom: 20px; padding: 15px;">
                    <legend><strong>Postar um Novo implante</strong></legend>
                <div>
                    <label for="nome">Nome do Implante:</label><br>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Lâminas de Louva-a-deus" required>
                </div>

                <br>

                <div>
                    <label for="tipo">Categoria / Tipo:</label><br>
                    <select id="tipo" name="tipo" required>
                        <option value="">Selecione...</option>
                        <option value="SISTEMA NERVOSO">Sistema Nervoso</option>
                        <option value="SISTEMA OCULAR">Sistema Ocular</option>
                        <option value="SISTEMA CIRCULATÓRIO">Sistema Circulatório</option>
                        <option value="MEMBROS">Membros</option>
                        <option value="PELE / ARMADURA">Pele / Armadura Subcutânea</option>
                    </select>
                </div>

                <br>

                <div>
                    <label for="preco">Preço (Edis €$):</label><br>
                    <input type="number" step="0.01" id="preco" name="preco" placeholder="Ex: 15000.00" required>
                </div>

                <br>

                <div>
                    <label for="descricao">Descrição Técnica:</label><br>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Especificações técnicas e requisitos..."></textarea>
                </div>

                <br>

                <button type="submit">Registrar Implante</button>
            </form>
            </fieldset>
        </section>

        <hr>

        <section>
            <h2>Catálogo de Implantes</h2>

            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Preço (€$)</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?php if (!empty($implantes)): ?>
                        <?php foreach ($implantes as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                                <td><strong><?= htmlspecialchars($item['nome'] ?? '') ?></strong></td>
                                <td><?= htmlspecialchars($item['tipo'] ?? '') ?></td>
                                <td>€$ <?= number_format($item['preco'] ?? 0, 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item['descricao'] ?? '') ?></td>
                                <td>
                                    <a href="editar_implante.php?id=<?= $item['id'] ?>">Editar</a> |
                                    <a href="excluir_implante.php?id=<?= $item['id'] ?>" onclick="return confirm('Excluir este registro permanentemente?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Nenhum implante registrado na base de dados.</td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>