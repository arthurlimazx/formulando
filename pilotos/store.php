<?php
require_once '../auth/protege.php';
include '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = trim($_POST['nome']    ?? '');
    $numero  = trim($_POST['numero']  ?? '');
    $titulos = trim($_POST['titulos'] ?? '0');
    $equipe  = trim($_POST['equipe']  ?? '');
    $user_id = $_SESSION['id'];

    if (empty($nome) || empty($numero) || empty($equipe)) {
        header("Location: create.php?erro=Preencha todos os campos");
        exit();
    }

    if (!is_numeric($numero) || $numero < 1 || $numero > 99) {
        header("Location: create.php?erro=Número inválido");
        exit();
    }

    if (!is_numeric($titulos) || $titulos < 0) {
        header("Location: create.php?erro=Títulos inválido");
        exit();
    }

    $sql = "INSERT INTO pilotos (nome, numero, titulos, equipe, user_id) VALUES (:nome, :numero, :titulos, :equipe, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome',    $nome);
    $stmt->bindValue(':numero',  $numero);
    $stmt->bindValue(':titulos', $titulos);
    $stmt->bindValue(':equipe',  $equipe);
    $stmt->bindValue(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: pilotos.php?sucesso=Piloto adicionado");
        exit();
    } else {
        header("Location: create.php?erro=Erro ao adicionar piloto");
        exit();
    }
}
?>