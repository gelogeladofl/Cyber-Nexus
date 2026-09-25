<?php
$host     = '192.168.10.45';
$port     = '5432'; // Porta padrão do PostgreSQL
$db       = 'cyber_nexus';
$user     = 'cyber_nexus';
$password = 'EuSouEspecial';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Erro na conexão com a rede/banco: " . $e->getMessage());
}