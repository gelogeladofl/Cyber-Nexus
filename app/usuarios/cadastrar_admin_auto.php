<?php
require_once __DIR__ . '/../../database/conexao.php';

$nome = 'Breno Luiz';
$apelido = 'lobo';
$email = 'brenoluiz1958@gmail.com';
$senhaTextoPuro = 'sla';
$senhaHash = password_hash($senhaTextoPuro, PASSWORD_DEFAULT);

try {
    // Apaga registro antigo de admin se houver inconsistência
    $pdo->exec("DELETE FROM usuarios WHERE email = '{$email}' OR apelido = '{$apelido}'");

    // Insere com hash gerado diretamente pelo PHP do seu ambiente
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, apelido, email, senha, nivel_acesso) VALUES (:nome, :apelido, :email, :senha, 'Admin')");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':apelido', $apelido);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':senha', $senhaHash);
    $stmt->execute();

    echo "<h1>Admin Cadastrado com Sucesso!</h1>";
    echo "<p><strong>Login:</strong> admin@cybernexus.com (ou admin_nexus)</p>";
    echo "<p><strong>Senha:</strong> 12345678</p>";
    echo "<p><a href='index.php'>Ir para a tela de Login</a></p>";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}