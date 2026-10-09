<?php
session_start();
require_once __DIR__ . '/../../database/conexao.php';

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $apelido = isset($_POST['apelido']) ? trim($_POST['apelido']) : '';
    $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha   = isset($_POST['senha']) ? $_POST['senha'] : '';

    if (!empty($nome) && !empty($apelido) && $email && !empty($senha)) {
        try {
            // Verifica se e-mail ou apelido já existem no PostgreSQL
            $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email OR apelido = :apelido");
            $check->bindValue(':email', $email);
            $check->bindValue(':apelido', $apelido);
            $check->execute();

            if ($check->rowCount() > 0) {
                die("<strong>Erro:</strong> Este E-mail ou Apelido de Rede já está em uso por outro operador!");
            }

            // Criptografa a senha com BCRYPT
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Cadastra como 'Operador' por padrão
            $sql = "INSERT INTO usuarios (nome, apelido, email, senha, nivel_acesso, criado_em) 
                    VALUES (:nome, :apelido, :email, :senha, 'Operador', CURRENT_TIMESTAMP)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':apelido', $apelido);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senhaHash);
            $stmt->execute();

            // Redireciona para a tela com mensagem de sucesso
            header('Location: index.php?status=sucesso');
            exit;

        } catch (PDOException $e) {
            die("<strong>Erro no Banco de Dados:</strong> " . htmlspecialchars($e->getMessage()));
        }
    } else {
        die("<strong>Erro de Validação:</strong> Por favor, preencha todos os campos corretamente.");
    }
} else {
    header('Location: index.php');
    exit;
}