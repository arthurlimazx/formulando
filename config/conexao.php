<?php

$host = $_ENV['DB_HOST'] ?? 'db';
$db   = $_ENV['DB_NAME'] ?? 'formula1';
$user = $_ENV['DB_USER'] ?? 'arthur';
$pass = $_ENV['DB_PASS'] ?? 'eeep@3103';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}