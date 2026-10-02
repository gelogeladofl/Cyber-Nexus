<?php
require_once __DIR__ . '/../../database/conexao.php';

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome      = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $dificuldade = filter_input(INPUT_POST, 'dificuldade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $recompensa  = filter_input(INPUT_POST, 'recompensa', FILTER_VALIDATE_FLOAT);
    $status      = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';

    if (!empty($nome) && !empty($dificuldade) && $recompensa !== false && !empty($status) && !empty($descricao)) {
        try {
            if ($id) {
                // UPDATE quando o ID oculto está presente
                $sql = "UPDATE missoes 
                        SET nome = :nome, 
                            dificuldade = :dificuldade, 
                            recompensa = :recompensa, 
                            status = :status, 
                            descricao = :descricao 
                        WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            } else {
                // INSERT para novos cadastros
                $sql = "INSERT INTO missoes (nome, dificuldade, recompensa, status, descricao, criado_em) 
                        VALUES (:nome, :dificuldade, :recompensa, :status, :descricao, CURRENT_TIMESTAMP)";
                $stmt = $pdo->prepare($sql);
            }

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':dificuldade', $dificuldade);
            $stmt->bindValue(':recompensa', $recompensa);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':descricao', $descricao);

            $stmt->execute();

            header('Location: mural.php?status=sucesso');
            exit;

        } catch (PDOException $e) {
            die("<strong>Erro de Banco de Dados:</strong> " . htmlspecialchars($e->getMessage()));
        }
    } else {
        die("<strong>Erro:</strong> Todos os campos obrigatórios precisam ser preenchidos.");
    }
} else {
    header('Location: mural.php');
    exit;
}