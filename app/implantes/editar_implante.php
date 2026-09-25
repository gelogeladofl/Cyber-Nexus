<?php
require_once __DIR__ . '/../../database/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM implantes WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $implante = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$implante) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    die("Erro ao carregar implante: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Implante — Cyber Nexus</title>
</head>
<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h2>Editar Implante #<?= htmlspecialchars($implante['id']) ?></h2>

            <form action="salvar_implante.php" method="POST">
                
                <input type="hidden" name="id" value="<?= htmlspecialchars($implante['id']) ?>">

                <div>
                    <label for="nome">Nome do Implante:</label><br>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($implante['nome']) ?>" required>
                </div>

                <br>

                <div>
                    <label for="tipo">Categoria / Tipo:</label><br>
                    <select id="tipo" name="tipo" required>
                        <?php 
                        $categorias = [
                            'SISTEMA NERVOSO', 
                            'SISTEMA OCULAR', 
                            'SISTEMA CIRCULATÓRIO', 
                            'MEMBROS', 
                            'PELE / ARMADURA'
                        ];
                        foreach ($categorias as $cat): 
                            $selected = ($implante['tipo'] === $cat) ? 'selected' : '';
                        ?>
                            <option value="<?= $cat ?>" <?= $selected ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <br>

                <div>
                    <label for="preco">Preço (Edis €$):</label><br>
                    <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($implante['preco']) ?>" required>
                </div>

                <br>

                <div>
                    <label for="descricao">Descrição Técnica:</label><br>
                    <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($implante['descricao']) ?></textarea>
                </div>

                <br>

                <button type="submit">Salvar Alterações</button>
                <a href="index.php">Cancelar</a>
            </form>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>