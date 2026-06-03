<?php
include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $titulos = $_POST['titulos'];
    $equipe = $_POST['equipe'];

    $sql = "INSERT INTO pilotos (nome, numero, titulos, equipe) VALUES (:nome, :numero, :titulos, :equipe)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':numero', $numero);
    $stmt->bindValue(':titulos', $titulos);
    $stmt->bindValue(':equipe', $equipe);
    

    if ($stmt->execute()) {
        header("Location: pilotos.php");
        exit();
    } else {
        echo "Erro ao adicionar piloto.";
    }
}
?>