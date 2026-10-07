<?php
require_once __DIR__ . '/../../database/conexao.php';

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome      = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $codinome  = isset($_POST['codinome']) ? trim($_POST['codinome']) : '';
    $funcao    = isset($_POST['funcao']) ? trim($_POST['funcao']) : '';
    $distrito  = isset($_POST['distrito']) ? trim($_POST['distrito']) : '';
    $reputacao = isset($_POST['reputacao']) ? trim($_POST['reputacao']) : '';
    $status    = isset($_POST['status']) ? trim($_POST['status']) : '';
    $biografia = isset($_POST['biografia']) ? trim($_POST['biografia']) : '';

    if (!empty($nome) && !empty($codinome) && !empty($funcao) && !empty($distrito) && !empty($reputacao) && !empty($status) && !empty($biografia)) {
        try {
            if ($id) {
                // UPDATE
                $sql = "UPDATE agentes 
                        SET nome = :nome, 
                            codinome = :codinome, 
                            funcao = :funcao, 
                            distrito = :distrito, 
                            reputacao = :reputacao, 
                            status = :status, 
                            biografia = :biografia 
                        WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            } else {
                // INSERT
                $sql = "INSERT INTO agentes (nome, codinome, funcao, distrito, reputacao, status, biografia, criado_em) 
                        VALUES (:nome, :codinome, :funcao, :distrito, :reputacao, :status, :biografia, CURRENT_TIMESTAMP)";
                $stmt = $pdo->prepare($sql);
            }

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':codinome', $codinome);
            $stmt->bindValue(':funcao', $funcao);
            $stmt->bindValue(':distrito', $distrito);
            $stmt->bindValue(':reputacao', $reputacao);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':biografia', $biografia);

            $stmt->execute();

            header('Location: mural.php?status=sucesso');
            exit;

        } catch (PDOException $e) {
            die("<strong>Erro no Banco de Dados:</strong> " . htmlspecialchars($e->getMessage()));
        }
    } else {
        die("<strong>Erro de Validação:</strong> Todos os campos obrigatórios precisam ser preenchidos.");
    }
} else {
    header('Location: mural.php');
    exit;
}