<?php

$host = $_ENV['DB_HOST'] ?? 'db';
$db   = $_ENV['DB_NAME'] ?? 'formula1';
$user = $_ENV['DB_USER'] ?? 'seu_usuario';
$pass = $_ENV['DB_PASS'] ?? 'sua_senha';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}