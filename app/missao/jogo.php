<?php
require_once __DIR__ . '/../../database/conexao.php';

$queryPrincipais = $pdo->query("SELECT * FROM missoes_principais ORDER BY id ASC");
$missoesPrincipais = $queryPrincipais->fetchAll();

$totalMissoes = count($missoesPrincipais);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Nexus — Missões Principais</title>
</head>

<body>

    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main>
        <section>
            <h1>Campanha Principal — Cyberpunk 2077</h1>
            <p><strong>Total de missões catalogadas:</strong> <?= $totalMissoes ?></p>

            <table border="1" cellpadding="8" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ato</th>
                        <th>Dificuldade</th>
                        <th>Recompensa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($missoesPrincipais)): ?>
                        <tr>
                            <td colspan="7" align="center">Nenhuma missão principal encontrada no banco de dados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($missoesPrincipais as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><strong><?= htmlspecialchars($item['nome']) ?></strong></td>
                                <td><?= htmlspecialchars($item['descricao']) ?></td>
                                <td><?= htmlspecialchars($item['ato']) ?></td>
                                <td><?= htmlspecialchars($item['dificuldade']) ?></td>
                                <td>€$ <?= number_format($item['recompensa'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item['status']) ?></td>
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