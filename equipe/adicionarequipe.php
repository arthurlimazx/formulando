<?php
include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipe = $_POST['equipe'];
    $numero = $_POST['descricao'];
    $titulos = $_POST['titulos'];
    

    $sql = "INSERT INTO equipes (equipe, descricao, titulos) VALUES (:equipe, :descricao, :titulos)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':equipe', $equipe);
    $stmt->bindValue(':descricao', $numero);
    $stmt->bindValue(':titulos', $titulos);
    $user= $stmt->execute();
    

    if ($user) {
        header("Location: equipes.php");
        exit();
    } else {
        echo "Erro ao adicionar equipe.";
    }
}
?>