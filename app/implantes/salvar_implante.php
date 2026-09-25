<?php
require_once __DIR__ . '/../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = filter_input(INPUT_POST, 'id', );
    $nome      = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo      = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
    $preco     = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($nome && $tipo && $preco !== false) {
        try {
            if ($id) {
                // Atualizar implante existente
                $sql = "UPDATE implantes SET nome = :nome, tipo = :tipo, preco = :preco, descricao = :descricao WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            } else {
                // Inserir novo implante
                $sql = "INSERT INTO implantes (nome, tipo, preco, descricao) VALUES (:nome, :tipo, :preco, :descricao)";
                $stmt = $pdo->prepare($sql);
            }

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':tipo', $tipo);
            $stmt->bindValue(':preco', $preco);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->execute();

        } catch (PDOException $e) {
            die("Erro ao salvar dados: " . $e->getMessage());
        }
    }
}

header('Location: index.php');
exit;