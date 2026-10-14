<?php
require_once __DIR__ . '/../../database/conexao.php';

// Configurações do Novo Administrador
$nome          = 'Novo Administrador';
$apelido       = 'novo_admin';
$email         = 'novo_admin@cybernexus.com';
$senhaTextoPuro = 'admin1234'; // Defina a senha desejada aqui

// Gera o Hash BCRYPT compatível com o password_verify()
$senhaHash = password_hash($senhaTextoPuro, PASSWORD_DEFAULT);

try {
    // 1. Remove qualquer conta antiga com o mesmo apelido ou e-mail (para evitar conflito UNIQUE)
    $stmtDelete = $pdo->prepare("DELETE FROM usuarios WHERE email = :email OR apelido = :apelido");
    $stmtDelete->bindValue(':email', $email);
    $stmtDelete->bindValue(':apelido', $apelido);
    $stmtDelete->execute();

    // 2. Insere o novo usuário com nível de acesso 'Admin'
    $stmtInsert = $pdo->prepare("
        INSERT INTO usuarios (nome, apelido, email, senha, nivel_acesso) 
        VALUES (:nome, :apelido, :email, :senha, 'Admin')
    ");
    $stmtInsert->bindValue(':nome', $nome);
    $stmtInsert->bindValue(':apelido', $apelido);
    $stmtInsert->bindValue(':email', $email);
    $stmtInsert->bindValue(':senha', $senhaHash);
    $stmtInsert->execute();

    echo "<div style='font-family: Arial, sans-serif; padding: 20px; background-color: #0d1117; color: #00ffcc; border: 2px solid #00ffcc; max-width: 500px; margin: 40px auto;'>";
    echo "<h2 style='color: #ff0055;'>[ CYBER NEXUS ] Novo Admin Criado!</h2>";
    echo "<p><strong>Apelido:</strong> {$apelido}</p>";
    echo "<p><strong>E-mail:</strong> {$email}</p>";
    echo "<p><strong>Senha:</strong> {$senhaTextoPuro}</p>";
    echo "<p><strong>Nível de Acesso:</strong> Admin</p>";
    echo "<hr style='border-color: #00ffcc;'>";
    echo "<p><a href='index.php' style='color: #ffcc00; font-weight: bold;'>Ir para a Tela de Login</a></p>";
    echo "</div>";

} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Erro ao criar Administrador: " . htmlspecialchars($e->getMessage()) . "</h3>";
}